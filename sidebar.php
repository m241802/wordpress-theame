<?php
/**
 * The Sidebar containing the main widget areas.
 * If no widgets are set, the content below will be displayed
 *
 * @package msa
 */
?>
<section id="sidebar"<?php if(!is_front_page()){;?>class="post-sidebar"<?php };?>>
	
	<?php if ( ! dynamic_sidebar( 'primary' ) ) : ?>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>	
		
	    <aside id="categories" class="widget"><h4>Categories</h4>
			<ul>
				<?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</aside>
		
		<aside id="archives" class="widget"><h4>Archives</h4>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</aside>
		
		<aside id="subscribe" class="widget"><h4>Subscribe</h4>
			<ul>
			   	<li><a href="<?php bloginfo( 'rss2_url' ); ?>">Entries (RSS)</a></li>
			 	<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>">Comments (RSS)</a></li>
			</ul>
		</aside>		
	<?php endif; ?>
	    <aside id="sidebar-news"><h4>Новости</h4>
			<ul>
				<?php
				global $post;
				$args = array( 'numberposts' => 3, 'post_type'=> 'news' );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
					<li class="clear" >
					    <a class="sidebar-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('shop_thumbnail'); ?></a>
					    <span class="sidebar-time" href="<?php the_permalink(); ?>"><?php the_time('j F Y'); ?></span>
					    <a class="sidebar-post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endforeach; ?>
				<?php wp_reset_postdata() ?>
			</ul>
		</aside>
		<aside id="sidebar-post"><h4>Блог</h4>
			<ul>
				<?php
				global $post;
				$args = array( 'numberposts' => 3, 'post_type'=> 'post' );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
					<li class="clear" >
					    <a class="sidebar-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('shop_thumbnail'); ?></a>
					    <span class="sidebar-time" href="<?php the_permalink(); ?>"><?php the_time('j F Y'); ?></span>
					    <a class="sidebar-post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endforeach; ?>
				<?php wp_reset_postdata() ?>
			</ul>
		</aside>
	
</section>