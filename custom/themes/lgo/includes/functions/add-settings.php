<?php
class LGOSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'LGO Settings', 
            'manage_options', 
            'lgo-settings-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'lgo_option_name' );
        ?>
        <div class="wrap">
            <h1>LGO Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'lgo_option_group' );
                do_settings_sections( 'lgo-settings-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'lgo_option_group', // Option group
            'lgo_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Social Media', // lgo_facebook
            array( $this, 'print_section_info' ), // Callback
            'lgo-settings-admin' // Page
        );  

        add_settings_field(
            'lgo_twitter', // ID
            'Twitter Username', // lgo_facebook 
            array( $this, 'lgo_twitter_callback' ), // Callback
            'lgo-settings-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'lgo_facebook', 
            'Facebook Page Link', 
            array( $this, 'lgo_facebook_callback' ), 
            'lgo-settings-admin', 
            'setting_section_id'
        );    

        add_settings_field(
            'lgo_instagram', 
            'Instagram Username', 
            array( $this, 'lgo_ig_callback' ), 
            'lgo-settings-admin', 
            'setting_section_id'
        );    

        add_settings_field(
            'lgo_youtube', 
            'Youtube Page Link', 
            array( $this, 'lgo_yt_callback' ), 
            'lgo-settings-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['lgo_twitter'] ) )
            $new_input['lgo_twitter'] = sanitize_text_field( $input['lgo_twitter'] );

        if( isset( $input['lgo_facebook'] ) )
            $new_input['lgo_facebook'] = sanitize_text_field( $input['lgo_facebook'] );

        if( isset( $input['lgo_instagram'] ) )
            $new_input['lgo_instagram'] = sanitize_text_field( $input['lgo_instagram'] );

        if( isset( $input['lgo_youtube'] ) )
            $new_input['lgo_youtube'] = sanitize_text_field( $input['lgo_youtube'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print '';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function lgo_twitter_callback()
    {
        printf(
            '@ <input type="text" id="lgo_twitter" name="lgo_option_name[lgo_twitter]" value="%s" />',
            isset( $this->options['lgo_twitter'] ) ? esc_attr( $this->options['lgo_twitter']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function lgo_facebook_callback()
    {
        printf(
            '<input type="text" id="lgo_facebook" name="lgo_option_name[lgo_facebook]" value="%s" />',
            isset( $this->options['lgo_facebook'] ) ? esc_attr( $this->options['lgo_facebook']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function lgo_ig_callback()
    {
        printf(
            '@ <input type="text" id="lgo_instagram" name="lgo_option_name[lgo_instagram]" value="%s" />',
            isset( $this->options['lgo_instagram'] ) ? esc_attr( $this->options['lgo_instagram']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function lgo_yt_callback()
    {
        printf(
            '<input type="text" id="lgo_youtube" name="lgo_option_name[lgo_youtube]" value="%s" />',
            isset( $this->options['lgo_youtube'] ) ? esc_attr( $this->options['lgo_youtube']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new LGOSettingsPage();
?>