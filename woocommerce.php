<?php
/**
 * The Template for displaying all woocomerce.
 *
 * @package msa
 */
/* перемещение цены ниже на стр. одиночного товара*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
/*замена meta-данных на кастомные */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_template_single_meta', 40);
function custom_woocommerce_template_single_meta(){
    wc_get_template( 'msa-meta.php' );
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 50 );
/* изменение onsail*/
add_filter('woocommerce_sale_flash', 'my_custom_sale_flash', 10, 3);
function my_custom_sale_flash($text, $post, $_product) {
  return '<span class="on-sale">Акция</span>';  
}
remove_action(  'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
/* title одиночный товар перед картинками*/
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 1);
/* измение надписи с "добавить в корзину" на "купить" (стр. одиночного товара)*/
add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  
function woo_custom_single_add_to_cart_text() {  
    return __( 'Купить', 'woocommerce' );  
}
/* изменим надпись с добавить в корзину на купить (стр. "цикл" товаров)*/
add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' ); 
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );
function woo_custom_product_add_to_cart_text() {  
    return __( 'Купить', 'woocommerce' );  
}
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
function msa_thumbnail_product() {
	$title_img = get_the_title(get_the_ID());
	$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID(), 'shop_single'));
	$thumbnail_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID(), 'full'));
	$arr = get_post_meta(get_the_ID(), '_product_image_gallery', true);
	$arr_gallery = explode(",", $arr);
	$arr_elems = count($arr_gallery);
	echo '<div class="product-thumbnail">';
	echo '<a rel="example_group" href="'.$thumbnail_src_full[0].'">';
	echo '<img alt="'.$title_img.'" src="'.$thumbnail_src[0].'" width="'.$thumbnail_src[1].'" height="'.$thumbnail_src[2].'">';
	echo '</a>';
	echo '<div class="wrap-product-gallery"><div class="product-gallery">';
	for ($i=0; $i < $arr_elems; $i++) { 		
		$image_src = wp_get_attachment_image_src($arr_gallery[$i], 'shop_thumbnail');
		$image_src_full = wp_get_attachment_image_src($arr_gallery[$i], 'full');		
		if(isset($image_src[0])){
		    echo '<div class="image-gallery">';
		    echo '<a rel="example_group" href="'.$image_src_full[0].'">';
		    echo '<img alt="'.$title_img.'" src="'.$image_src[0].'" width="90" height="90">';
		    echo '</a>';
		    echo '</div>';
	    }
	}
	echo '</div></div></div>';
}
add_action( 'woocommerce_before_single_product_summary', 'msa_thumbnail_product', 20 );


/*add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
*/
get_header(); ?>

<div id="main">
	
	<section id="content">
	  <?php woocommerce_breadcrumb(); ?>
	  <?php woocommerce_content(); ?>
	  <?php 
	  ?>
    </section>
	
<?php get_sidebar(); ?>

</div><!-- end of main div -->

<?php get_footer(); ?>