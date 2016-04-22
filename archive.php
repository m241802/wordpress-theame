<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package msa
 */

get_header(); ?>

<div id="main">
	
	<section id="content">
		
	<?php if (have_posts()) : ?>
	
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		
		<?php if (is_category()) { ?>				
			<h1><?php echo single_cat_title(); ?></h1>
			
		<?php } elseif( is_tag() ) { ?>
			<h1><?php _e( 'Posts Tagged:', 'msa' ); ?> <?php single_tag_title(); ?></h1>
			
		<?php } elseif (is_day()) { ?>
			<h1><?php _e( 'Archive for', 'msa' ); ?> <?php echo get_the_date(); ?></h1>
			
		<?php } elseif (is_month()) { ?>
			<h1><?php _e( 'Archive for', 'msa' ); ?> <?php echo get_the_date( _x( 'F Y', 'monthly archives date format', 'msa' ) ) ?></h1>
			
		<?php } elseif (is_year()) { ?>
			<h1><?php _e( 'Archive for', 'msa' ); ?> <?php echo get_the_date( _x( 'Y', 'yearly archives date format', 'msa' ) ) ?></h1>
			
		<?php } elseif (is_search()) { ?>
			<h1><?php _e( 'Search Results', 'msa' ); ?></h1>
			
		<?php } elseif (is_author()) { ?>
			<h1><?php _e( 'Author Archive', 'msa' ); ?></h1>
			
		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1><?php _e( 'Blog Archives', 'msa' ); ?></h1>
			
		<?php } ?>
	
	<?php while (have_posts()) : the_post(); ?>
			
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
	    	<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
			<?php get_template_part( 'inc/meta' ); ?>
	
		 	<?php the_excerpt();?>
			
		</article>
	
	  <?php endwhile; endif; ?>
	
	  <?php get_template_part( 'inc/nav' ); ?>
		  
	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- #main -->

<?php get_footer(); ?>