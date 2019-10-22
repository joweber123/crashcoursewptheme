<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */

function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

function show_post($path) {
    $post = get_page_by_path($path);
    $content = apply_filters('the_content', $post->post_content);
    return $content;
  }

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

/**
 * Overriding featured image 
 */

function storefront_page_header() {
    if ( is_front_page() ) {
        ?>
        <header class="entry-header">
            
            <div class="header-container">
                <span class="header-site-title">Crash</br>Course</br>Travel</span>
                <?php the_title( '<h1 class="entry-title">', '</h1>' );?>
            </div>
            <div class=header-color-container></div>
            <?php storefront_post_thumbnail( 'full' );?>

        </header><!-- .entry-header -->
        <?php
    } elseif( is_cart() || is_checkout()){
        return;
    } else{
        ?>
        <header class="entry-header">
            
            <div class="header-container">
                <?php the_title( '<h1 class="header-entry-title">', '</h1>' );?>
            </div>
            <div class=header-color-container></div>
            <?php storefront_post_thumbnail( 'full' );?>

        </header><!-- .entry-header -->
        <?php
    }
}

/**
 * Add Google Font
 */
add_action( 'storefront_header', 'custom_storefront_header_content', 40 );
	function custom_storefront_header_content() { 
        ?>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Roboto+Slab:300,400&display=swap" rel="stylesheet"> 		
        <?php
    }
    
/**
 * Functions hooked into storefront_header action
 *
 * @hooked storefront_header_container                 - 0
 
 * @hooked storefront_skip_links                       - 5
 * @hooked storefront_social_icons                     - 10
 * @hooked storefront_site_branding                    - 20
 * @hooked storefront_secondary_navigation             - 30
 * @hooked storefront_product_search                   - 40
 * @hooked storefront_header_container_close           - 41
 * @hooked storefront_primary_navigation_wrapper       - 42
 * @hooked storefront_primary_navigation               - 50
 * @hooked storefront_header_cart                      - 60
 
 * @hooked storefront_primary_navigation_wrapper_close - 68
 */

 /* Voiding storefront default header functions */

 function storefront_site_branding() {
    return;
}
function storefront_product_search() {
    return;
}
function storefront_primary_navigation_wrapper() {
     return;
}
function storefront_primary_navigation_wrapper_close() {
     return;	
}
function storefront_primary_navigation() {
    return;
}
function storefront_header_container_close() {
    return;
}

    

function storefront_header_container() {

        ?>
        
		<div class="site-branding">
			<?php storefront_site_title_or_logo(); ?>
        </div>
        
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'primary-navigation',
				)
			);

			wp_nav_menu(
				array(
					'theme_location'  => 'handheld',
					'container_class' => 'handheld-navigation',
				)
			);
			?>
		</nav>
		<?php
    }

 
function storefront_handheld_footer_bar() {
    $links = array(
        'cart'       => array(
            'priority' => 30,
            'callback' => 'storefront_handheld_footer_bar_cart_link',
        ),
    );

    if ( wc_get_page_id( 'cart' ) === -1 ) {
        unset( $links['cart'] );
    }

    $links = apply_filters( 'storefront_handheld_footer_bar_links', $links );
    ?>
    <div class="storefront-handheld-footer-bar">
        <?php foreach ( $links as $key => $link ) : ?>
            <div class="<?php echo esc_attr( $key ); ?>">
                <?php
                if ( $link['callback'] ) {
                    call_user_func( $link['callback'], $key, $link );
                }
                ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}


	function storefront_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
		</div><!-- .site-info -->
		<?php
	}

    
//woocommerce: Remove Original Product Image function
  remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// =============================================================================

// woocommerce: Add Header to Product Pages using Product Image
// =============================================================================
function display_header_product_page(){
?>
    <header class="entry-header">
	<div class="header-container">
		<?php the_title( '<h1 class="header-entry-title">', '</h1>' );?>
	</div>
	<div class=header-color-container></div>
	<?php storefront_post_thumbnail( 'full' );?>
    </header><!-- .entry-header -->
<?php
}

add_action( 'woocommerce_before_single_product', 'display_header_product_page' );
// =============================================================================

// woocommerce: Add wrapping container around entry summary
function product_entry_wrapper_start(){
    ?>
    <div class="entry-wrapper-container">
    <?php
}
function product_entry_wrapper_end(){
    ?>
    </div>
    <?php
}



add_action( 'woocommerce_single_product_summary', 'product_entry_wrapper_start', 2 );
add_action( 'woocommerce_single_product_summary', 'product_entry_wrapper_end', 90 );
// =============================================================================

// woocommerce: Move Product tabs underneath the product images
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 6 );
// =============================================================================


// woocommerce: change position of add-to-cart on single product
// https://businessbloomer.com/woocommerce-visual-hook-guide-single-product-page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 1 );
// =============================================================================

// woocommerce: change position of price on single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );


// woocommerce: change position of description on single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 30 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 50 );
// =============================================================================




//WooCommerce: Add sample map to Maps Category
add_action( 'woocommerce_before_add_to_cart_button', 'woocomerce_single_category_slug', 40 );

function woocomerce_single_category_slug() {
    $woo_basic_map = get_field('basic_map_embed');
    if ( has_term( 'maps', 'product_cat' ) ) {
        echo $woo_basic_map;
    } 
    }



// =============================================================================

// WooCommerce: Add Teacher tab to Product page
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
// Adds the new tab
global $post;
$product = wc_get_product();
$product_type = $product->get_type();
if ( $product_type == 'booking' ) {
    $tabs['desc_tab'] = array(
        'title'     => __( 'Teacher', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_new_product_tab_content'
    );
}
    return $tabs;

}

// WooCommerce: Display Teach Tab Information
function woo_new_product_tab_content() {
    global $post;
    global $authordata;
    $profile = get_the_author_meta( 'first_name', $post->post_author );
    $product = wc_get_product();
    $product_type = $product->get_type();
    
    $link = sprintf(
        ' <a href="%1$s" title="%2$s" rel="author">Read More...</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        /* translators: %s: author's display name */
        esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ),
        get_the_author()
    );
 
    
    
    // The new tab content
    if ( $product_type == 'booking' ) {
    echo '<h2> Your Teacher: ';
    echo $profile.'</h2>';
    echo '<p> '. wp_trim_words(show_post($profile), 50).' </p>';
    echo $link;
    }
  }

//remove gravatar for review
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

// =============================================================================

// woocommerce: Category Page header

// =============================================================================


// Display category image on category archive
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        $title = woocommerce_page_title($echo);
	    if ( $image ) {
            echo '
            <header class="entry-header">
                <div class="header-container">
                    <h1 class="header-entry-title" >' . $title . '</h1>
                </div>
                <div class=header-color-container></div>
                <img class="wp-post-image" src="' . $image . '" alt="' . $cat->name . '" />
            </header><!-- .entry-header -->
            ';
		}
	}
}
// =============================================================================

// Add product image and title to category page
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );


add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title_background_image', 10 );

function woocommerce_template_loop_product_title_background_image(){
    global $post;
    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
    $image_source = get_the_post_thumbnail_url( $post->ID, $image_size );

    echo '
    <div class="category-product">
    <div class="category-product-title-container">
        <h2 class="category-product-title" >' . get_the_title() . '</h2>   
    </div>
    <div class="category-product-color-container"></div>
    <div style="background-image:url( '.$image_source .')" class="category-product-image-container">
    </div>
    '; 
}

// =============================================================================


//remove sorting and result count from category page
function woocommerce_catalog_ordering(){
    return;
}

function storefront_sorting_wrapper(){
    return;
}
function storefront_sorting_wrapper_close(){
    return;
}
function woocommerce_result_count(){
    return;
}

//Add author to WooCommerce Products
add_action('init', 'function_to_add_author_woocommerce', 999 );

function function_to_add_author_woocommerce() {
  add_post_type_support( 'product', 'author' );
}
// =============================================================================


// Add custom Author fields https://blog.webnersolutions.com/adding-custom-fields-to-user-profile-in-wordpress

function add_custom_userprofile_fields( $user ) {    
?>
    <table class="form-table">
        <tr>
            <th><label for="crash_course_profile"><?php _e('Crash Course Teacher Profile', 'your_textdomain'); ?></label></th>
            <td>
                <input type="text" name="crash_course_profile" id="crash_course_profile" value="<?php echo esc_attr( get_the_author_meta( 'crash_course_profile', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your crash course teacher profile.', 'your_textdomain'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
            <label for="user_phone"><?php _e('Phone No.', 'your_textdomain'); ?></label></th>
            <td>
                <input type="text" name="user_phone" id="user_phone" value="<?php echo esc_attr( get_the_author_meta( 'user_phone', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your phone number.', 'your_textdomain'); ?></span>
            </td>
        </tr>
    </table>
<?php 
}

function save_custom_userprofile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
    return FALSE;
    update_usermeta( $user_id, 'crash_course_profile', $_POST['crash_course_profile'] );
    update_usermeta( $user_id, 'user_phone', $_POST['user_phone'] );
}

add_action( 'show_user_profile', add_custom_userprofile_fields );
add_action( 'edit_user_profile', add_custom_userprofile_fields );
add_action( 'personal_options_update', 'save_custom_userprofile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_userprofile_fields' );
// =============================================================================




	function storefront_post_content() {
		?>
		<div class="entry-content">
		<?php
    
		if ( is_single() ) {
					/**
		 * Function controlling single post content
		 * Functions hooked in to storefront_post_content_before action.
		 * @hooked storefront_post_thumbnail - 10
		 */
        
        
		the_content(
			sprintf(
				/* translators: %s: post title */
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);


		do_action( 'storefront_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			)
        );

		} else {
		/**
		 * Function controlling post blurbs shown in grids
		 * Functions hooked in to storefront_post_content_before action.
		 * @hooked storefront_post_thumbnail - 10
		 */
		do_action( 'storefront_post_content_before' );

		the_excerpt(
			sprintf(
				/* translators: %s: post title */
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		do_action( 'storefront_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			)
        );
    }
		?>
		</div><!-- .entry-content -->
		<?php
    }



	function storefront_post_header() {
		?>
		<header class="entry-header">
		<?php

		/**
		 * Functions hooked in to storefront_post_header_before action.
		 *
		 * @hooked storefront_post_meta - 10
		 */
		do_action( 'storefront_post_header_before' );

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="alpha entry-title">', '</h2>' );
		}

		do_action( 'storefront_post_header_after' );
		?>
		</header><!-- .entry-header -->
		<?php
    }
  
    

function remove_storefront_post_meta() {
    if ( is_single() ) {
        return;
    } else {
    remove_action( 'storefront_post_header_before', 'storefront_post_meta', 10 );
    remove_action( 'storefront_loop_post', 'storefront_post_taxonomy', 40 );
    }
}
add_action( 'after_setup_theme', 'remove_storefront_post_meta', 0);


///////////////////////Single Post/////////////////////////////
//found in storefront-template-functions.php
//found in store-front-template-hooks.php
/*
add_action( 'storefront_loop_post', 'storefront_post_header', 10 );
add_action( 'storefront_loop_post', 'storefront_post_content', 30 );
add_action( 'storefront_loop_post', 'storefront_post_taxonomy', 40 );
add_action( 'storefront_loop_after', 'storefront_paging_nav', 10 );
add_action( 'storefront_single_post', 'storefront_post_header', 10 );
add_action( 'storefront_single_post', 'storefront_post_content', 30 );
add_action( 'storefront_single_post_bottom', 'storefront_edit_post_link', 5 );
add_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
add_action( 'storefront_single_post_bottom', 'storefront_post_nav', 10 );
add_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20 );
add_action( 'storefront_post_header_before', 'storefront_post_meta', 10 );
add_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10 );
*/


add_action( 'storefront_single_post', 'storefront_post_thumbnail', 05 );



















    