<?php
/**
 * This template will be used to display page content.
 *
 * @package msa
 */

get_header(); ?>

<div id="main">
	
	<section id="content">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		     <?php if(!is_front_page()){ ?>
			<h1 class="page-title"></h1>
                      <? }?>
			
			<?php the_content(); ?>
			
		</article>
		
	  <?php comments_template(); ?>

		<?php endwhile; endif; ?>
		
	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- #main -->

<?php get_footer(); ?>