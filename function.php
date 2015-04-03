<?php 
/*
Plugin Name: CTicker
Plugin URI: http://coderexperts.com/
Description: The plug-in will help you to using your News or Post as a ticker in your WordPress theme. You can embed news or post using the CTicker shortcode in everywhere you want, even in theme files. Also has a short-code button in your page & post editor, using it without write any code you able to insert the ticker. 
Author: Md. Sayfur Rahman
Version: 1.0
Author URI: http://sayfur-rahman.com
*/

function cticker_defalut_jquery() {
	wp_enqueue_script('jquery');
}

add_action('init', 'cticker_defalut_jquery');

function add_ctickermain_script() {
   wp_enqueue_script( 'cticker-js', plugins_url( '/js/jquery.webticker.min.js', __FILE__ ), array('jquery'), 1.0, false);
   wp_enqueue_style( 'post-css', plugins_url( '/css/style.css', __FILE__ ));
}

add_action('init','add_ctickermain_script');

include (dirname( __FILE__ ) . '/mce/mcebutton.php');

function cticker_shortcode($atts) {

	extract( shortcode_atts( array(
		'id' => 'ctickerid',
		'cticker_speed' => '20',
		'category' => '',
		'count' => '-1',
		'button_text' => 'Latest Post:',
		'background_color' => '#00ADED',
		'button_textcolor' => '#ffffff',
		'button_fontsize' => '14px',
		'right_bgcolor' => '#ffffff',
		'right_textcolor' => '#000',
		'right_fontsize' => '14px',
		'hover' => 'true',
		
	), $atts, 'projects' ) );
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'post', 'category_name' => $category,)
        );		
		
		$list = '<script type="text/javascript">
					jQuery(function(){
						jQuery("#cticker'.$id.'").webTicker({
						speed: '.$cticker_speed.',
						direction: "left",
						moving: true,
						startEmpty: false,
						duplicate: true,
						rssurl: false,
						rssfrequency: 0,
						updatetype: "reset",
						hoverpause: '.$hover.',
					});	
					});
				</script>
				<style>
					#'.$id.' .tickercontainer { background: '.$right_bgcolor.'; }
					ul#cticker'.$id.' a { color: '.$right_textcolor.'; font-size: '.$right_fontsize.'; }
				</style>
				<div class="ticker-body" id="'.$id.'">
				<div class="ticker-left" style="background-color: '.$background_color.'; color: '.$button_textcolor.'; font-size: '.$button_fontsize.';">
					<p><strong>'.$button_text.'</strong></p>
				</div>
				<ul id="cticker'.$id.'">';
					while($q->have_posts()) : $q->the_post();
						$idd = get_the_ID();
						$list.= '
		
			<li><strong><a href="'.get_permalink().'">'.get_the_title().'</a></strong><br></li>
		
		';        
	endwhile;
	$list.= '</ul></div>';
	wp_reset_query();
	return $list;
}

add_shortcode('cticker_list', 'cticker_shortcode');	
