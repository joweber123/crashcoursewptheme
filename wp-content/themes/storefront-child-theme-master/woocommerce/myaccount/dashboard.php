<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s,', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>
<p class="myaccount_content">Welcome to Crash Course Travel.  Here in your account you have access to all of your scheduled Travel Session information in one place.</p>
<p class="myaccount_content"><?php
	printf(
		__( 'You will want to head to your scheduled <a href="%1$s">Travel Sessions</a> to grab the Zoom link you will need to log in to your travel session.  Please be sure to confirm the time and date of your session there as well.  You can also manage the <a href="%2$s">password and account details</a>. for your account here as well.', 'woocommerce' ) ,
		esc_url( wc_get_endpoint_url( 'bookings' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>
<p class="myaccount_content">Feel free to reach out at info@crashcoursetravel.com with any concerns you may have.</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
