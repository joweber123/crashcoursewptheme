<?php
/**
 * Customer booking reminder email.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-bookings/emails/customer-booking-reminder.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/bookings-templates/
 * @author  Automattic
 * @version 1.10.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_email_header', $email_heading );
?>

<p>Hi there,</p>
<p>
	<?php
	/* translators: 1: booking start date */
	echo sprintf( __( 'This is just a quick reminder that you are signed up for a Crash Course Travel Session tomorrow %1$s.', 'woocommerce-bookings' ), $booking->get_start_date() );
	?>
</p>
<h2>Survey</h2>
<p>If you haven't had the chance to yet, please take the time to fill out the survey linked below to give us some necessary background information on your trip.</p>
<p><a class="crashcourse_email_button" href="https://forms.gle/ujhfP3P9vyHFUWhB6">Travel Planning Survey → </a></p>
<h2>Session</h2>
<p>Below is the Zoom link you will need to join that session. Once you have Zoom installed on your computer (explained below), you will simply need to click on the button below to join our session tomorrow.</p>
<p>
	<?php 
		$resource = $booking->get_resource();
		$post_id = $resource->ID;
		$zoomlink = get_field('teacher_resource_zoom_link', $post_id ); 
		echo '<a class="crashcourse_email_button" target="_blank" href="'. $zoomlink . '">Zoom Session Link → </a>';
	?>
</p>
<h2>Zoom</h2>
<p>If you haven't had a chance to yet, please install the screen share software, Zoom, for free by clicking this button below:</p>
<p><a href="https://zoom.us/ ">Download Zoom →</a></p>
<p>You will need to download Zoom in order to join our session.  We've found that this software offers the best audio and video quality for our calls.  For more information on joining a Zoom session and configuring your audio for it, here's a 48-second video to show you how to join a session with the link provided below:</p>
<p><a href="https://www.youtube.com/watch?v=HqncX7RE0wM">Zoom Configuration Video → </a></p>
<p>We will be seeing you tomorrow and do not hesitate to reach out to info@crashcoursetravel.com with any questions at all!</p>
<h2>Here's a summary for easy access.</h2>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<tbody>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Booking ID', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_id(); ?></td>
		</tr>
		<tr>
			<th scope="row" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Travel Session', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_product()->get_title(); ?></td>
		</tr>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Start Time', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_start_date( null, null, wc_should_convert_timezone( $booking ) ); ?></td>
		</tr>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'End Time', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_end_date( null, null, wc_should_convert_timezone( $booking ) ); ?></td>
		</tr>
		<?php if ( wc_should_convert_timezone( $booking ) ) : ?>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php esc_html_e( 'Time Zone', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( str_replace( '_', ' ', $booking->get_local_timezone() ) ); ?></td>
		</tr>
		<?php endif; ?>
		<?php
		$resource = $booking->get_resource();

		if ( $booking->has_resources() && $resource ) :
			?>
			<tr>
				<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Teacher', 'woocommerce-bookings' ); ?></th>
				<td style="text-align:left; border: 1px solid #eee;"><?php echo $resource->post_title; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Zoom Session Link', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;">	<?php $resource = $booking->get_resource(); $post_id = $resource->ID; $zoomlink = get_field('teacher_resource_zoom_link', $post_id ); echo '<a target="_blank" href="'. $zoomlink . '">'. $zoomlink . '</a>'; ?></td>
		</tr>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Travel Planning Survey', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><a href="https://forms.gle/ujhfP3P9vyHFUWhB6">https://forms.gle/ujhfP3P9vyHFUWhB6</a></td>
		</tr>
		<?php if ( $booking->has_persons() ) : ?>
			<?php
			foreach ( $booking->get_persons() as $id => $qty ) :
				if ( 0 === $qty ) {
					continue;
				}

				$person_type = ( 0 < $id ) ? get_the_title( $id ) : __( 'Person(s)', 'woocommerce-bookings' );
				?>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php echo $person_type; ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $qty; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_email_footer' ); ?>
