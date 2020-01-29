<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php
function crashcourse_teacher_zoom_link($order){
$items = $order->get_items();
foreach( $items as $item ) {
	$booking_ids = WC_Booking_Data_Store::get_booking_ids_from_order_item_id( $item->get_id() );
	foreach( $booking_ids as $booking_id ) {
		$booking = new WC_Booking($booking_id);
		$resource = $booking->get_resource();
		$post_id = $resource->ID;
		$zoomlink = get_field('teacher_resource_zoom_link', $post_id ); 
		echo '<a class="crashcourse_email_button" target="_blank" href="'. $zoomlink . '">Zoom Session Link → </a>';
	} break;
}	
}

function crashcourse_booking_time($order){
	$items = $order->get_items();
	foreach( $items as $item ) {
		$booking_ids = WC_Booking_Data_Store::get_booking_ids_from_order_item_id( $item->get_id() );
		foreach( $booking_ids as $booking_id ) {
			$booking = new WC_Booking($booking_id);
			$get_local_time = wc_should_convert_timezone( $booking );
			if ( strtotime( 'midnight', $booking->get_start() ) === strtotime( 'midnight', $booking->get_end() ) ) {
				$booking_date = sprintf( '%1$s', $booking->get_start_date( null, null, $get_local_time ) );
			} else {
				$booking_date = sprintf( '%1$s / %2$s', $booking->get_start_date( null, null, $get_local_time ), $booking->get_end_date( null, null, $get_local_time ) );
			}
			
			echo esc_html( apply_filters( 'wc_bookings_summary_list_date', $booking_date, $booking->get_start(), $booking->get_end() ) );
	
			$booking_timezone = str_replace( '_', ' ', $booking->get_local_timezone() ); 
			if ( wc_should_convert_timezone( $booking ) ):
				echo esc_html( sprintf( __( ' in timezone: %s', 'woocommerce-bookings' ), $booking_timezone ) );
			endif; 
		}break;
	}	
	}
?>

<?php /* translators: %s: Customer first name */ ?>
<p>
	<?php printf( 
		esc_html__( 'Hi there,', 'woocommerce' ) 
	); ?>
</p>
<?php /* translators: %s: Site title */ ?>
<p>Your payment has been recieved and your session has been successfully booked!  Thank you.  We are super excited for the chance to share in your adventure.</p>
<h2>Survey</h2>
<p>To make sure we are prepared to be the best teachers possible, please take the time to fill out the survey linked below to give us some necessary background information on your trip.</p>
<p><a class="crashcourse_email_button" href="https://forms.gle/ujhfP3P9vyHFUWhB6">Travel Planning Survey → </a></p>
<h2>Session</h2>
<p>We'll be meeting on <?php crashcourse_booking_time($order); ?> for your upcoming lesson.  Let us know as soon as possible of any discrepancy so we can get your session rescheduled.</p>
<p>Below is the Zoom link you will need to join that session. Once you have Zoom installed on your computer (explained below), you will simply need to click on the button below to join our session.</p>
<p><?php crashcourse_teacher_zoom_link($order); ?></p>
<h2>Zoom</h2>
<p>We'll meet via Zoom.  We've found that this software offers the best audio and video quality for our calls.  To prepare for our session, please install the screen share software, Zoom, for free directly from Zoom.  The button below will take you directly to their site.</p>
<p><a href="https://zoom.us/ ">Download Zoom →</a></p>
<p>For more information on joining a Zoom session and configuring your audio for it, here's a 48-second video to show you how to join a session with the link provided below:</p>
<p><a href="https://www.youtube.com/watch?v=HqncX7RE0wM">Zoom Configuration Video → </a></p>
<p>We will be seeing you soon and do not hesitate to reach out with any questions at all!</p>
<?php


/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additonal content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );