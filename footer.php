<?php
/**
 * The template for displaying the footer.
 * 
 * @package msa
 */
?>
</div><!-- !wrap -->
<footer>
    <div class="footer-wrap">
         <a href="<?php echo home_url() ?>/"><div id="logo-mini"></div></a>
	     <?php wp_nav_menu( array( 'theme_location' => 'buyer-footer', 'depth' => 3 ) ); ?> 
	     <?php wp_nav_menu( array( 'theme_location' => 'info-footer', 'depth' => 3 ) ); ?>
	     <?php wp_nav_menu( array( 'theme_location' => 'about-us-footer', 'depth' => 3 ) ); ?>

    </div>
	 <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php _e( 'Все права защищены.', 'msa' ); ?></p>
     <div id="arrow-top"></div>
</footer>
<?php wp_footer(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/slick-carusel/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/castom.js"></script>
</body>
</html>