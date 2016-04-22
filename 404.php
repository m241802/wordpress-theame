<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package msa
 */

get_header(); ?>

<div id="main">

	<section id="content">

		<article class="hentry">		
			<h1><?php _e( 'Oops... File or page not found.', 'msa' ); ?></h1>
			<p><?php _e( 'We have recently made changes to our website and the page you are looking for might have been deleted or moved. Please', 'msa' ); ?> <a href="<?php echo home_url(); ?>"><?php _e( 'visit our home page instead', 'msa' ); ?></a>.</p>
			<p><?php _e( 'Sorry for the inconvenience', 'msa' ); ?>.</p>		
		</article>

	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- end of main div -->

<?php get_footer(); ?>