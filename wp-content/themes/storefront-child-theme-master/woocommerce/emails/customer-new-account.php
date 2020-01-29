<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s Customer username */ ?>
<p>
	<?php printf( 
		esc_html__( 'Hi there,', 'woocommerce' ) 
	); ?>
</p>
<?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>
<p>
    <?php printf(
        esc_html__('We are super excited to welcome you to Crash Course Travel.  We hope to make it as easy as possible for you to access all of your scheduled travel session information in one place .  Feel free to log in to your Crash Course Travel account using the provided username and password below.','woocommerce')
    );?>
</p>
<p>
	<?php printf( 
		make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) 
	); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>
<p>
	<?php printf( 
		esc_html__( 'Username: %s', 'woocommerce' ), '<strong>' . esc_html( $user_login ) . '</strong>'
		); ?>
</p>
<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
	<?php /* translators: %s Auto generated password */ ?>
	<p>
		<?php printf( 
			esc_html__( 'Automatically generated password: %s', 'woocommerce' ), '<strong>' . esc_html( $user_pass ) . '</strong>' 
		); ?>
	</p>
<?php endif; ?>
<p>
    <?php printf(
        esc_html__('We recommend logging in now and changing this to a custom password.','woocommerce')
    );?>
</p>
<?php
/**
 * Show user-defined additonal content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
