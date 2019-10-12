<?php
/**
 * This is being used as the template for the posts page
 *

 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        <header class="entry-header">
            
            <div class="header-container">
                <?php single_post_title( '<h1 class="header-entry-title">', '</h1>' );?>
            </div>
            <div class=header-color-container></div>
            <?php storefront_post_thumbnail( 'full' );?>

        </header><!-- .entry-header -->

		<?php
		if ( have_posts() ) :

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
