<?php
/**
 * This is our template for displaying our Author Page
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
			global $post;
			global $authordata;
			$profile = get_the_author_meta( 'first_name', $post->post_author );
			
			$post_id = get_page_by_title($profile);    
			$post_thumbnail_id = get_post_thumbnail_id( $post_id ); 
			$image = wp_get_attachment_image_src( $post_thumbnail_id, 'full' ); 
			
			?>
			<header class="entry-header">
            
            <div class="header-container">
			<h1 class="header-entry-title"><?php echo $profile ?></h1> 
            </div>
            <div class=header-color-container></div>
            <img class="attachment-full size-full wp-post-image" src="<?php echo $image[0]; ?>" />
			</header><!-- .entry-header -->
			<?php

			echo show_post($profile);?>
			<?php if ( have_posts() ) : 
			echo '<h3>Some cool Posts '. $profile.' has written</h3>';
			get_template_part( 'loop' );
			else :

				get_template_part( 'content', 'none' );
			
			endif;
			?>






		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();


		
