<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Send an email notification when a new inquiry is submitted.
 */
final class LNS_Inq_Notifications {

    public static function init(): void {
        add_action( 'lns_inq_new_inquiry', [ __CLASS__, 'send_notification' ] );
    }

    public static function send_notification( int $post_id ): void {
        $to = get_option( 'lns_inq_notification_email', get_option( 'admin_email' ) );
        if ( ! is_email( $to ) ) {
            return;
        }

        $name     = get_post_meta( $post_id, '_lns_full_name', true );
        $phone    = get_post_meta( $post_id, '_lns_phone', true );
        $email    = get_post_meta( $post_id, '_lns_email', true );
        $address  = get_post_meta( $post_id, '_lns_address', true );
        $svc_key  = get_post_meta( $post_id, '_lns_service', true );
        $service  = LNS_Inq_CPT::SERVICES[ $svc_key ] ?? $svc_key;
        $message  = get_post_meta( $post_id, '_lns_message', true );
        $contact  = get_post_meta( $post_id, '_lns_contact_method', true );

        $subject = sprintf( '[New Inquiry] %s – %s', $name, $service );

        $body  = "A new quote inquiry has been submitted.\n\n";
        $body .= "Name:             {$name}\n";
        $body .= "Phone:            {$phone}\n";
        $body .= "Email:            {$email}\n";
        $body .= "Address / City:   {$address}\n";
        $body .= "Service Needed:   {$service}\n";
        $body .= "Preferred Contact: {$contact}\n\n";
        $body .= "Message:\n{$message}\n\n";
        $body .= "---\n";
        $body .= 'View in admin: ' . admin_url( 'post.php?post=' . $post_id . '&action=edit' ) . "\n";

        $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

        wp_mail( $to, $subject, $body, $headers );
    }
}
