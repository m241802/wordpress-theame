<?php
/**
 * msa functions and definitions
 *
 * @package msa
 */

    
add_theme_support( 'woocommerce' );
add_action( 'after_setup_theme', 'msa_theme_setup' );
function msa_theme_setup() {

    global $content_width;
    /* Set the $content_width for things such as video embeds. */
    if ( !isset( $content_width ) )
    $content_width = 680;

    /* Add theme support for automatic feed links. */
    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    /* Add theme support for post thumbnails (featured images). */
add_theme_support( 'post-thumbnails' );
    update_option( 'medium_size_h', 175);
    update_option( 'medium_size_w', 235);
    update_option('medium_crop', 1);
    update_option( 'large_size_h', 440);
    update_option( 'large_size_w', 1200);
    update_option('large_crop', 1);
    update_option( 'thumbnail_size_h', 9999);
    update_option( 'thumbnail_size_w', 400);
    update_option('thumbnail_crop', 0);
}

/* Add your nav menus function to the 'init' action hook. */
   add_action( 'init', 'msa_register_menus' );

/* Add custom actions. */
   add_action( 'widgets_init', 'msa_register_sidebars' );



// Add menu features 
function msa_register_menus() {
    register_nav_menus(array('primary'=>__( 'Primary Menu' ), ));
    register_nav_menus(array('buyer-footer'=>__( 'Footer buyer Menu' ), ));
    register_nav_menus(array('info-footer'=>__( 'Footer Info' ), ));
    register_nav_menus(array('about-us-footer'=>__( 'about us info' ), ));
}

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function msa_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'msa_page_menu_args' );

function msa_register_sidebars() {
    register_sidebar(
        array(
            'id' => 'primary',
            'name' => __( 'Primary Sidebar', 'msa' ),
            'description' => __( 'The following widgets will appear in the main sidebar div.', 'msa' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        )
    );
        register_sidebar(
        array(
            'id' => 'header',
            'name' => __( 'header Sidebar', 'msa' ),
            'description' => __( 'Сайтбар дня корзины и социалок в шапке', 'msa' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
}

/**
 * Enqueue scripts and styles
 */

function msa_scripts() {

    if ( ! is_admin() ) {
 
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    
        wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Muli|Rokkitt:700' );

        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', null, '4.0.1' );

        wp_enqueue_script( 'msa_navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

        }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }
}
add_action( 'wp_enqueue_scripts', 'msa_scripts' );

/*function jquery_in_footer() {
wp_register_script( 'tie-tipsy', get_bloginfo('url') . '/wp-includes/js/jquery/jquery.js', array( 'jquery' ), '1.11.1' );
wp_register_script( 'tie-easing', get_bloginfo('url') . '/wp-includes/js/jquery/jquery-migrate.min.js', array( 'jquery'), '1.2.1') ;
}*/


//Set up title if SEO plugin is not used.

function msa_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'msa' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'msa_wp_title', 10, 2 );

function msa_wp_pagination() {
global $wp_query;
$big = 12345678;
$page_format = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type'  => 'array'
) );
if( is_array($page_format) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div><ul>';
            foreach ( $page_format as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div>';
}
}

function msa_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'msa_excerpt_length', 999 );

function msa_excerpt_more($more) {
       global $post;
    return '...<span class="read-more"><a href="'. get_permalink($post->ID) . '">Continue Reading &rarr;</a></span>';
}
add_filter('excerpt_more', 'msa_excerpt_more');
function the_breadcrumb() {
    echo ' ';
    if (!is_front_page()) {
        echo '<a href="';
        echo get_option('home');
        echo '">Главная';
        echo "</a> » ";
        if (is_category() || is_single()) {
            the_category(' ');           
            if (is_single()) {
               if (has_term()) {  
                echo " / "; 
            }         
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }
    }
    else {
        echo 'Home';
    }
}
function do_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
    array_pop($words);
    echo implode(' ', $words).' ...';
}
/*add_filter('robots_txt', 'add_robotstxt');
function add_robotstxt($output){
    $output .= "Allow: $path/wp-content/uploads/\n"; 
    $output .= "Disallow: $path/wp-login.php\n";
    $output .= "Disallow: $path/wp-register.php\n";
    $output .= "Disallow: $path/xmlrpc.php\n";
    $output .= "Disallow: $path/template.html\n";
    $output .= "Disallow: $path/cgi-bin\n";
    $output .= "Disallow: $path/wp-admin\n";
    $output .= "Disallow: $path/wp-includes\n";
    $output .= "Disallow: $path/wp-content/plugins\n";
    $output .= "Disallow: $path/wp-content/cache\n";
    $output .= "Disallow: $path/wp-content/themes\n";
    $output .= "Disallow: $path/trackback\n";
    $output .= "Disallow: $path/feed\n";
    $output .= "Disallow: $path/comments\n";
    $output .= "Disallow: $path/comment-page*\n";
    $output .= "Disallow: $path/replytocom=\n";
    $output .= "Disallow: $path/author*\n";
    $output .= "Disallow: $path/?author=*\n";
    $output .= "Disallow: $path/tag\n";
    $output .= "Disallow: $path/?feed=\n";
    $output .= "Disallow: $path/?s=\n";
    $output .= "Disallow: $path/?se=\n";
    $output .= "Disallow: $path/about_us.html\n";
    $output .= "Disallow: $path/akcii\n";
    $output .= "Disallow: $path/bathroom_accessories\n";
    $output .= "Disallow: $path/bathroom_furniture\n";
    $output .= "Disallow: $path/baths\n";
    $output .= "Disallow: $path/bidet\n";
    $output .= "Disallow: $path/contacts.html\n";
    $output .= "Disallow: $path/delivery.html\n";
    $output .= "Disallow: $path/faq.html\n";
    $output .= "Disallow: $path/hydroboxing\n";
    $output .= "Disallow: $path/index.html\n";
    $output .= "Disallow: $path/installations\n";
    $output .= "Disallow: $path/interior.html\n";
    $output .= "Disallow: $path/interior\n";
    $output .= "Disallow: $path/minipools\n";
    $output .= "Disallow: $path/mirrors\n";
    $output .= "Disallow: $path/mixer_%20taps\n";
    $output .= "Disallow: $path/news.html\n";
    $output .= "Disallow: $path/producers.html\n";
    $output .= "Disallow: $path/rakoviny_i_umyvalniki\n";
    $output .= "Disallow: $path/shower_enclosures\n";
    $output .= "Disallow: $path/special.html\n";
    $output .= "Disallow: $path/tile\n";
    $output .= "Disallow: $path/toilets\n";
    $output .= "Disallow: $path/towel_warmers\n";
    $output .= "Disallow: $path/*private\n";

    $output .= "Host: msaweb.ru\n";
    $output .= "Sitemap: http://msaweb.ru/sitemap.xml\n";

return $output;
}*/



add_action( 'init', 'turSlide' );
function turSlide() {
    register_post_type( 'turSlide',
        array(
            'labels' => array(
                'name' => 'Слайдер',
                'singular_name' => 'Слайдер',
                'add_new' => 'Добавить новый Слайдер',
                'add_new_item' => 'Добавить новый Слайдер',
                'edit' => 'Измененить',
                'edit_item' => 'Изменить Слайдер',
                'new_item' => 'Добавить новый Слайдер',
                'view' => 'Посмотреть',
                'view_item' => 'Посмотреть Слайдер',
                'search_items' => 'Найти Слайдер',
                'not_found' => 'Слайдеры не найдены',
                'not_found_in_trash' => 'В корзине не найдено Слайдеров',
                'parent' => 'Родительский Слайдер'
            ),
            'public' => true,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'thumbnail', ),
            'taxonomies' => array( '' ),            
            'has_archive' => true
        )
    );
}
function true_status_planned(){
    register_post_status( 'planned', array(
        'label'                     => 'Запланированные',
        'public'                    => true
    ) );
} 
add_action( 'init', 'true_status_planned' );

add_action( 'init', 'msa_post_type' );
function msa_post_type() {
register_post_type( 'interiors',
        array(
            'labels' => array(
                'name' => 'Интерьеры',
                'singular_name' => 'Интерьер',
                'add_new' => 'Добавить новый Интерьер',
                'add_new_item' => 'Добавить новый Интерьер',
                'edit' => 'Измененить',
                'edit_item' => 'Изменить Интерьертовар',
                'new_item' => 'Добавить новый Интерьер',
                'view' => 'Посмотреть Интерьер',
                'view_item' => 'Посмотреть Интерьер',
                'search_items' => 'Найти Интерьер',
                'not_found' => 'Интерьер не найден',
                'not_found_in_trash' => 'В корзине нет удалённого Интерьера',
                'parent' => 'Родительский Интерьер'
            ),
            'public' => true,
            'menu_position' => 2,
            'supports' => array( 'title','editor','author','thumbnail','excerpt','comments'  ),
            /* callback-функция для обновления счетчика $object_type */
           /* 'taxonomies' => array('category', 'post_tag'),*/
            /*'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),*/
            'has_archive' => true
        )
    );
        register_post_type( 'news',
        array(
            'labels' => array(
                'name' => 'Новости',
                'singular_name' => 'Интерьер',
                'add_new' => 'Добавить Новость',
                'add_new_item' => 'Добавить Новость',
                'edit' => 'Измененить Новость',
                'edit_item' => 'Изменить Новость',
                'new_item' => 'Добавить Новость',
                'view' => 'Посмотреть Новость',
                'view_item' => 'Посмотреть Новость',
                'search_items' => 'Найти Новость',
                'not_found' => 'Новость не найдена',
                'not_found_in_trash' => 'В корзине нет удалённой Новости',
                'parent' => 'Родительский Новость'
            ),
            'public' => true,
            'menu_position' => 2,
            'supports' => array( 'title','editor','author','thumbnail','excerpt','comments'  ),
            /* callback-функция для обновления счетчика $object_type */
            'taxonomies' => array(/*'category',*/ 'post_tag'),
            /*'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),*/
            'has_archive' => true
        )
    );
    register_post_type( 'faq', array(
        'labels' => array(
        'name' => 'FAQs',
        'singular_name' => 'FAQ'
    ),
        'has_archive' => true,
        'public' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'rewrite' => array ('slug' => 'faqs' ),
        )
    );
}

function add_msa_taxonomies() { 
    register_taxonomy('manufacturers',
        array('product', 'interiors'),
        array(
            'hierarchical' => true,
            /* true - по типу рубрик, false - по типу меток, 
            по умолчанию - false */
            'labels' => array(
                /* ярлыки, нужные при создании UI, можете
                не писать ничего, тогда будут использованы
                ярлыки по умолчанию */
                'name' => 'Производители',
                'singular_name' => 'Производител',
                'search_items' =>  'Найти Производителя',
                'popular_items' => 'Популярные Производители',
                'all_items' => 'Все Производители',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать Производителя', 
                'update_item' => 'Обновить Производителя',
                'add_new_item' => 'Добавить нового Производителя',
                'new_item_name' => 'Название нового Производителя',
                'separate_items_with_commas' => 'Разделяйте Производителей запятыми',
                'add_or_remove_items' => 'Добавить или удалить Производителя',
                'choose_from_most_used' => 'Выбрать из наиболее часто используемых Производителя',
                'menu_name' => 'Производители'
            ),
            'public' => true, 
            /* каждый может использовать таксономию, либо
            только администраторы, по умолчанию - true */
            'show_in_nav_menus' => true,
            /* добавить на страницу создания меню */
            'show_ui' => true,
            /* добавить интерфейс создания и редактирования */
            'show_tagcloud' => true,
            /* нужно ли разрешить облако тегов для этой таксономии */
            'update_count_callback' => '_update_post_term_count',
            /* callback-функция для обновления счетчика $object_type */
            'query_var' => true,
            /* разрешено ли использование query_var, также можно 
            указать строку, которая будет использоваться в качестве 
            него, по умолчанию - имя таксономии */
            'rewrite' => array(
            /* настройки URL пермалинков */
                'slug' => 'manufacturers', // ярлык
                'hierarchical' => true // разрешить вложенность
 
            ),
        )
    );
}
add_action( 'init', 'add_msa_taxonomies', 0 );
add_filter( 'woocommerce_page_title', 'custom_woocommerce_page_title');
function custom_woocommerce_page_title( $page_title ) {
  if( $page_title == 'Shop' ) {
    return "";
  }
}

/* изменим количества товаров на странице магазина */
add_filter('loop_shop_per_page', create_function('$cols', 'return 20;'));

// убрать непонятные ссылки для Windows Live Writer
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// отключить вывод мета тэга "generator"
remove_action('wp_head', 'wp_generator');

// скрыть версию WordPress
function gb_hide_wp_ver()
{
    return '';
}
add_filter('the_generator','gb_hide_wp_ver');
/*add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');        
    }
}
*/
?>