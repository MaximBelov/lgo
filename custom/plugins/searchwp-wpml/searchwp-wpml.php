<?php
/*
Plugin Name: SearchWP WPML Integration
Plugin URI: https://searchwp.com/
Description: Integrate SearchWP with WPML
Version: 1.4.0
Author: Jonathan Christopher
Author URI: https://searchwp.com/

Copyright 2013-2017 Jonathan Christopher

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/>.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SEARCHWP_WPML_VERSION' ) ) {
	define( 'SEARCHWP_WPML_VERSION', '1.4.0' );
}

/**
 * Instantiate the updater
 */
if ( ! class_exists( 'SWP_WPML_Updater' ) ) {
	// load our custom updater
	include_once( dirname( __FILE__ ) . '/vendor/updater.php' );
}


/**
 * Set up the SearchWP WPML Updater
 *
 * @return bool|SWP_WPML_Updater
 */
function searchwp_wpml_update_check() {

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return false;
	}

	// environment check
	if ( ! defined( 'SEARCHWP_PREFIX' ) ) {
		return false;
	}

	if ( ! defined( 'SEARCHWP_EDD_STORE_URL' ) ) {
		return false;
	}

	if ( ! defined( 'SEARCHWP_WPML_VERSION' ) ) {
		return false;
	}

	// Retrieve stored license key
	$license_key = trim( get_option( SEARCHWP_PREFIX . 'license_key' ) );
	$license_key = sanitize_text_field( $license_key );

	// Instantiate the updater to prep the environment
	$searchwp_wpml_updater = new SWP_WPML_Updater( SEARCHWP_EDD_STORE_URL, __FILE__, array(
			'item_id' 	=> 33645,
			'version'   => SEARCHWP_WPML_VERSION,
			'license'   => $license_key,
			'item_name' => 'WPML Integration',
			'author'    => 'Jonathan Christopher',
			'url'       => site_url(),
		)
	);

	return $searchwp_wpml_updater;
}

add_action( 'admin_init', 'searchwp_wpml_update_check' );

/**
 * Class SearchWP_WPML
 */
class SearchWP_WPML {

	/**
	 * SearchWP_WPML constructor.
	 */
	function __construct() {
		add_action( 'after_plugin_row_' . plugin_basename( __FILE__ ), array( $this, 'plugin_row' ), 11 );

		add_filter( 'searchwp_query_join',              array( $this, 'join_wpml' ), 10, 2 );
		add_filter( 'searchwp_query_conditions',        array( $this, 'force_current_language' ) );
		add_filter( 'searchwp_indexer_taxonomy_terms',  array( $this, 'handle_multilingual_taxonomy' ), 10, 3 );

		// prevent interference with the indexer
		add_action( 'searchwp_indexer_pre',             array( $this, 'remove_all_unwanted_filters' ) );
	}

	/**
	 * Prevent WPML from filtering the indexer query for unindexed posts
	 */
	function remove_all_unwanted_filters() {
		remove_all_filters( 'posts_join' );
		remove_all_filters( 'posts_where' );
		remove_all_filters( 'pre_get_posts' );
	}

	/**
     * Generates the SQL to JOIN to the WPML tables
     *
	 * @param $sql
	 * @param $postType
	 *
	 * @return string
	 */
	function join_wpml( $sql, $postType ) {
		global $wpdb, $sitepress;

		if ( ! empty( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) && method_exists( $sitepress, 'get_default_language' ) && post_type_exists( $postType ) ) {
			$prefix = $wpdb->prefix;

			$sql .= " LEFT JOIN {$prefix}icl_translations t ON {$prefix}posts.ID = t.element_id ";
			$sql .= " AND t.element_type LIKE %s LEFT JOIN {$prefix}icl_languages l ON t.language_code=l.code AND l.active=1 ";

			$sql = $wpdb->prepare( $sql, 'post_' . $postType );
		}

		return $sql;
	}

	/**
     * Limit results to the current language as defined by WPML
     *
	 * @param $sql
	 *
	 * @return string
	 */
	function force_current_language( $sql ) {
		global $wpdb, $sitepress;

		if ( ! empty( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) && method_exists( $sitepress, 'get_default_language' ) ) {
			$currentLanguage = $sitepress->get_current_language();
			$defaultLanguage = $sitepress->get_default_language();

			if ( $currentLanguage == $defaultLanguage ) {
				$sql .= " AND (t.language_code='%s' OR t.language_code IS NULL) ";
			} else {
				$sql .= " AND (t.language_code='%s') ";
			}

			$sql = $wpdb->prepare( $sql, $currentLanguage );
		}

		return $sql;
	}

	/**
	 * Ensure the translated taxonomy terms are indexed for the current post
	 *
	 * @param $terms
	 * @param $taxonomy
	 * @param $post_being_indexed
     *
     * @since 1.4.0
	 *
	 * @return mixed
	 */
	function handle_multilingual_taxonomy( $terms, $taxonomy, $post_being_indexed ) {
		global $sitepress;

		// Make sure we can get the default language
		if ( empty( $sitepress ) || ! method_exists( $sitepress, 'get_default_language' ) ) {
			return $terms;
		}

		// Is the post being indexed non-default language?
		$post_lang = apply_filters( 'wpml_post_language_details', NULL, $post_being_indexed->ID ) ;
		$default_lang = $sitepress->get_default_language();

		if ( ! empty( $post_lang['language_code'] ) && $post_lang['language_code'] == $default_lang ) {
			return $terms;
		}

		// Retrieve the translated taxonomy terms
		$sitepress->switch_lang( $post_lang['language_code'] );
		$terms = wp_get_object_terms( array( $post_being_indexed->ID ), $taxonomy );

		return $terms;
	}

	/**
	 * Output notice if there are version incompatibilities
	 */
	function plugin_row() {
		if ( ! class_exists( 'SearchWP' ) ) { ?>
            <tr class="plugin-update-tr searchwp">
                <td colspan="3" class="plugin-update">
                    <div class="update-message">
						<?php esc_html_e( 'SearchWP must be active to use this Extension', 'searchwpwpml' ); ?>
                    </div>
                </td>
            </tr>
		<?php }
		else {
			$searchwp = SearchWP::instance();
			if ( version_compare( $searchwp->version, '1.1', '<' ) ) { ?>
				<tr class="plugin-update-tr searchwp">
					<td colspan="3" class="plugin-update">
						<div class="update-message">
							<?php esc_html_e( 'SearchWP WPML Integration requires SearchWP 1.1 or greater', 'searchwpwpml' ); ?>
						</div>
					</td>
				</tr>
			<?php }
		}
	}

}

new SearchWP_WPML();
