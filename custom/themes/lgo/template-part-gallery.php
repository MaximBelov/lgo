<?php 
/**
* Gallery Template Part
*/
?>

<div id="columns">

<?php $args = array(
    'post_type' => 'lg',
    'posts_per_page' =>100,
    'orderby' => 'menu_order', 
    'order' => 'DESC'
    );

    $loop = new WP_Query($args); ?>

    <?php while($loop->have_posts()) : $loop->the_post();
?>

<figure class="element">
    <a href="<?php echo the_permalink();?>">
    	<div class="clip-svg" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
    		
    	</div>
    	<!-- <img class="clip-svg" src="<?php the_post_thumbnail_url(); ?>"> -->
    </a>
    
	<svg height="0" width="0" id="frame" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	    <defs>
	        <clipPath id="boop">
	        	<path d="M169.652019,162.279165 C169.652019,162.279165 165.551621,163.681041 165.3731,169.10478 C165.3731,169.10478 166.19318,168.054685 166.884947,167.970678 C166.884947,167.970678 164.447024,170.87419 165.311734,175.195329 C165.311734,175.195329 165.852875,173.725197 166.96305,173.499426 C166.96305,173.499426 164.55302,177.500287 163.811044,178.639639 C163.069067,179.784243 160.246766,184.315401 156.123495,183.879612 C156.123495,183.879612 159.392656,186.426091 158.276901,188.368766 C157.635342,189.487117 153.629783,188.342514 153.557259,188.379267 C153.557259,188.379267 157.32851,191.776323 155.169525,194.706087 C153.077485,197.546593 148.893405,199.557525 148.631203,199.683536 C148.714885,199.578527 149.401074,198.764703 149.423389,198.712199 C149.451283,198.649718 143.939455,198.313163 142.561498,200.072071 C142.622865,199.956561 143.102639,199.048229 143.102639,199.011475 C143.102639,198.974722 138.555939,199.263498 135.800026,203.579387 C135.800026,203.579387 129.350964,207.343976 121.875409,199.699813 C121.875409,199.699813 116.586732,201.578957 116.307794,199.142737 C116.307794,199.142737 118.6453,198.958971 119.030235,196.507 C119.270122,194.979112 117.858693,192.973431 114.589532,192.973431 C110.768072,192.973431 108.397094,196.333734 108.430567,199.699813 C108.430567,199.699813 99.6439995,197.3371 92.4864341,202.035748 C92.4864341,202.035748 89.2619034,200.16658 85.100139,200.156079 L84.9160395,200.156079 C80.7492541,200.177081 77.4795354,202.534543 77.4795354,202.534543 C70.32197,197.830119 61.5354029,200.192832 61.5354029,200.192832 C61.5750122,196.832529 59.198455,193.466976 55.3820165,193.466976 C52.1134136,193.466976 50.6964053,195.472657 50.9357347,197.000544 C51.3212279,199.452515 53.6581758,199.641532 53.6581758,199.641532 C53.3792371,202.072501 48.0961393,200.192832 48.0961393,200.192832 C40.6150051,207.838046 34.1665017,204.072932 34.1665017,204.072932 C31.41003,199.757043 26.8638881,199.468267 26.8638881,199.50502 C26.8638881,199.541773 27.3431047,200.455356 27.4050291,200.570866 C26.0270722,198.806707 20.5146869,199.142737 20.5431386,199.205743 C20.5710325,199.258248 21.2566636,200.072071 21.3403452,200.177081 C21.0787008,200.051069 16.8946212,198.045388 14.7964448,195.204882 C12.6380176,192.269868 16.4142889,188.872812 16.4142889,188.872812 C16.336744,188.841309 12.3306272,189.980662 11.6896263,188.862311 C10.5788926,186.919636 13.8424747,184.378407 13.8424747,184.378407 C9.7197616,184.808945 6.90303924,180.277787 6.16050458,179.133184 C5.41350691,177.993831 3.00849798,173.992971 3.00849798,173.992971 C4.11365286,174.218741 4.65423594,175.694124 4.65423594,175.694124 C5.51894572,171.367734 3.08715868,168.464222 3.08715868,168.464222 C3.77836862,168.54823 4.59900609,169.598325 4.59900609,169.598325 C4.41490659,164.174586 0.320087392,162.772709 0.320087392,162.772709 C-1.63861972,151.757217 6.03219281,149.657027 6.03219281,149.657027 C2.03221275,146.501493 6.79648468,144.448558 6.79648468,144.448558 C6.43944322,146.044702 7.3604986,146.596001 7.3604986,146.596001 C9.74765546,148.181644 13.2790186,147.682849 13.3855732,142.841913 C13.4854332,138.000977 8.13036924,137.528434 8.13036924,137.528434 C1.23444825,137.92222 0.185638969,130.986345 0.101957378,127.431774 L0.180618073,127.431774 L0.180618073,77.1007382 L0.14658756,77.1007382 C0.313950742,73.4411584 1.55801707,67.0880858 8.163284,67.4661199 C8.163284,67.4661199 13.5133271,66.9988278 13.4129092,62.1578915 C13.3130491,57.3169552 9.77554932,56.8181602 7.39341336,58.4038031 C7.39341336,58.4038031 6.47291586,58.9551028 6.83051519,60.5512467 C6.83051519,60.5512467 2.06624326,58.4983116 6.06064455,55.3427772 C6.06064455,55.3427772 -1.61016798,53.242588 0.347981256,42.2270952 C0.347981256,42.2270952 4.44782135,40.8252188 4.62634208,35.40148 C4.62634208,35.40148 3.80682036,36.4515747 3.11449466,36.5355822 C3.11449466,36.5355822 5.54739746,33.6320706 4.6821298,29.3056806 C4.6821298,29.3056806 4.14656762,30.7810636 3.03694972,31.0068339 C3.03694972,31.0068339 5.44642167,27.0059734 6.18839845,25.8613702 C6.93037522,24.7220175 9.74765546,20.1908592 13.8765052,20.621398 C13.8765052,20.621398 10.6067865,18.0749185 11.722541,16.1374938 C12.3529423,15.0348945 16.2525045,16.1269929 16.436604,16.1269929 C16.2642199,15.9642282 12.7155626,12.6564301 14.8299174,9.79492221 C16.9894604,6.86515817 21.3799545,4.81747362 21.3799545,4.81747362 C21.3799545,4.81747362 20.5983685,5.73630643 20.5710325,5.79406163 C20.5481595,5.85706731 26.059987,6.1930976 27.4323651,4.4289386 C27.3709986,4.54444901 26.891782,5.45803135 26.891782,5.49478466 C26.891782,5.53153797 31.4440606,5.23751147 34.1994164,0.926872974 C34.1994164,0.926872974 40.6428989,-2.83771631 48.1240332,4.80697267 C48.1240332,4.80697267 53.4132676,2.92730326 53.6866275,5.35827236 C53.6866275,5.35827236 51.3541426,5.54728939 50.9697652,7.99926038 C50.7293201,9.52714808 52.1407496,11.5328288 55.4104683,11.5328288 C59.2313697,11.5328288 61.6023482,8.16727552 61.5632967,4.80697267 C61.5632967,4.80697267 70.3498638,7.16968561 77.5074293,2.46526162 C77.5074293,2.46526162 80.7765901,4.82272409 84.9439333,4.84372598 L85.1280328,4.84372598 C89.2897973,4.83322504 92.5199067,2.96405658 92.5199067,2.96405658 C99.6774722,7.66323009 108.464039,5.30051715 108.464039,5.30051715 C108.424988,8.66607047 110.795966,12.0263733 114.617983,12.0263733 C117.886586,12.0263733 119.298016,10.0206926 119.058687,8.49280486 C118.673193,6.04083387 116.341266,5.85706731 116.341266,5.85706731 C116.614626,3.42084774 121.903303,5.30051715 121.903303,5.30051715 C129.384437,-2.34417183 135.82792,1.42041745 135.82792,1.42041745 C138.584391,5.73630643 143.136112,6.02508245 143.136112,5.98832914 C143.136112,5.95157583 142.656337,5.04324396 142.594971,4.92773355 C143.967349,6.68664208 149.479176,6.35061179 149.456861,6.28760611 C149.428968,6.22985091 148.648497,5.3110181 148.648497,5.3110181 C148.648497,5.3110181 153.038433,7.35870265 155.197419,10.2937172 C157.311773,13.1499746 153.764232,16.4577727 153.590732,16.6205374 C153.774832,16.6205374 157.679972,15.5284389 158.304795,16.6310383 C159.42055,18.5737134 156.151389,21.1149424 156.151389,21.1149424 C160.279681,20.6844036 163.096961,25.215562 163.838938,26.3601652 C164.580914,27.4995179 166.990944,31.5003784 166.990944,31.5003784 C165.880768,31.2746081 165.345206,29.8044756 165.345206,29.8044756 C164.480496,34.125615 166.912841,37.0291267 166.912841,37.0291267 C166.221631,36.9451191 165.400994,35.8950245 165.400994,35.8950245 C165.579515,41.3187633 169.679913,42.7206397 169.679913,42.7206397 C171.63862,53.7361324 163.967807,55.8363217 163.967807,55.8363217 C167.961651,58.9918561 163.197379,61.0447911 163.197379,61.0447911 C163.559999,59.4538978 162.633923,58.8973476 162.633923,58.8973476 C160.251787,57.3117047 156.715403,57.8104996 156.614427,62.6566864 C156.514009,67.4976227 161.864052,67.9649148 161.864052,67.9649148 C168.184802,67.6026322 169.596231,73.3939041 169.852855,77.1007382 L169.847834,77.1007382 L169.847834,124.974553 L169.813803,124.911547 C169.813803,124.911547 169.830539,125.079562 169.847834,125.373589 L169.847834,127.431774 L169.852855,127.431774 C169.674334,131.096605 168.430825,137.412924 161.836158,137.03489 C161.836158,137.03489 156.481094,137.502182 156.586533,142.343118 C156.686951,147.189305 160.224451,147.6881 162.606029,146.097207 C162.606029,146.097207 163.527084,145.545907 163.169485,143.955013 C163.169485,143.955013 167.933757,146.002698 163.939355,149.164008 C163.939355,149.164008 171.604589,151.264197 169.652019,162.279165 Z" id="path-1"></path>
	        </clipPath>
	    </defs>
	</svg>

    <figcaption><a href="<?php echo the_permalink();?>"><?php echo the_title();?></a></figcaption>
</figure>
<?php endwhile; ?>

</div>
