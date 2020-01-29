<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<div class="error-404 not-found">

				<div class="page-content">
		
					<header class="page-header">
						<img src="http://crashcoursetravel.com/wp-content/uploads/2020/01/rice_field_black_white_404.png" alt="image of rock formation">
						<h1 class="page-title"><?php esc_html_e( 'Sorry!', 'storefront' ); ?></h1>
					</header><!-- .page-header -->

					<p><?php esc_html_e( 'Looks like that page has been deleted or moved. Here are some links that might be useful to reach out to us.'); ?></p>

					<ul class="error-navigation-container">
						<li><a href="./contact">Contact</li></a>
						<li><a href="./faq">FAQ</li></a>
						<li><a href="./">Site Home</li></a>
					</ul>

				</div><!-- .page-content -->

			</div><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
