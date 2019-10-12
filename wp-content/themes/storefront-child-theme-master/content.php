<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<a class="post-link-container" href="
    <?php
        $permalink = get_permalink();
        echo $permalink;
    ?>
">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php
        /**
         * Functions hooked in to storefront_loop_post action.
         *
         * @hooked storefront_post_header          - 10
         * @hooked storefront_post_content         - 30
         */
        do_action( 'storefront_loop_post' );
        ?>

    </article><!-- #post-## -->
</a>

