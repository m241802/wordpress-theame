<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section, header and top navigation areas
 *
 * @package msa
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <link rel="icon" href="http://msaweb.ru/wp-content/uploads/2014/1/logo-ico.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://msaweb.ru/wp-content/uploads/2014/11/logo-ico.ico" type="image/x-icon" />
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />       
	<title><?php wp_title( ' ', true, 'right' ); ?></title>
    <meta name="keywords" content="сантехника, плитка, керамическая плитка, мозаика, гресс, плитка для ванной, душевые кабины, полотенцесушители, унитазы, смесители, плитка для кухни, купить плитку в Симферополе, купить плитку в Крыму, купить сантехнику в Симферополе, купить сантехнику в Крым">
    <meta name="description" content="Купите плитку, сантехнику, ванны, душевые кабины, полотенцесушители, унитазы, смесители  в интернет магазине салона плитки и сантехники Атриум">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />  	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php /*include_once("analyticstracking.php");*/?>
<div class="contact-form">
<!-- 	<?php echo do_shortcode('[contact-form-7 id="57" title="Заказать"]'); ?> -->
	<span class="close-form"></span>
	<div class="substrate-form"></div>
</div>
<div id="wrap-site">	
<div id="top-wrap">  
    <div class="top-inner"> 
        <header id="branding" class="site-header" role="banner"> 
			 <div class="topbar-logged">
				<div id="topbar" class="topbar">
			  	    <div class="header-card">
				        <a href="<?php echo home_url() ?>/cart">				        
					         <?php echo WC()->cart->get_cart_contents_count();?>			         
					    </a>
				    </div>
					<div id="social" class="social-media">
				    	 <a class="vk" href="#" title="ВКонтакте"></a>
				    	 <a class="fb" href="#" title="Facebook"></a>
				    	 <a class="gp" href="#" title="Google+"></a>
				    </div>		     
				 </div>
			</div>
			<a href="<?php echo home_url() ?>/"><div id="logo"></div></a>		
			<span class="to-order">Заказать</span>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="menu-toggle"><?php _e( 'Menu', 'msa' ); ?></div>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'msa' ); ?></a>
		        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
			</nav><!-- #site-navigation -->		
		</header>
		<div class="clear"></div>
	</div>
</div>
<div id="wrap">	
<?php if(is_home() || is_front_page()){ ?>
  <div class="slide-wrapp">
	<div class="autoplay">
	<?php  
	    if (!wpmd_is_phone()){ 
		    if (wpmd_is_tablet()) {
			    $sise_slide = 'medium';
			} else {
			    $sise_slide = 'large';
			}		
		    ?>
	        <?php 
	         $sliders = get_posts( array(
				'post_type'       => 'turSlide',
				'post_status'     => 'publish'
			 ) );
	         foreach ($sliders as $slider): 
	               
	         ?>          
	            <?php $attach_url = wp_get_attachment_image_src(get_post_thumbnail_id($slider->ID), $sise_slide); ?>
	             <div class="slide">
		             <a href="<?php echo get_post_meta($slider->ID, 'link', true); ?>">
		                 <img height="440" width="1200" src="<?php echo $attach_url[0];?>">
		             </a> 
	                     <div class="description-slide" >
	                      <?php
	                          $page_id = $slider->ID; 
	                          $page_data = get_page( $page_id ); 
	                           print apply_filters('the_content', $page_data->post_content);
	                       ?>
	                     </div>                  
	             </div>
	         <?php endforeach ?>         
	         </div>	
	        </div>
    <?php }}?>