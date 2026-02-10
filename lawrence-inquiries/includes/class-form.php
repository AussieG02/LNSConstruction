<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Front-end [get_quote_form] shortcode, validation, and submission.
 */
final class LNS_Inq_Form {

    public static function init(): void {
        add_shortcode( 'get_quote_form', [ __CLASS__, 'render_shortcode' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );
    }

    /* -------------------------------------------------------------- */
    /*  Assets                                                        */
    /* -------------------------------------------------------------- */
    public static function enqueue_assets(): void {
        global $post;
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'get_quote_form' ) ) {
            wp_enqueue_style(
                'lns-inq-form',
                LNS_INQ_URL . 'assets/css/form.css',
                [],
                LNS_INQ_VERSION
            );
        }
    }

    /* -------------------------------------------------------------- */
    /*  Shortcode renderer                                            */
    /* -------------------------------------------------------------- */
    public static function render_shortcode(): string {

        /* ---- Handle submission (standard POST) ---- */
        $success = false;
        $errors  = [];
        if ( isset( $_POST['lns_inq_submit'] ) ) {
            $result = self::process_submission();
            if ( $result === true ) {
                $success = true;
            } else {
                $errors = $result;
            }
        }

        /* ---- Build form markup ---- */
        ob_start();

        if ( $success ) : ?>
            <div class="lns-inq-success" role="alert">
                <strong>Thank you!</strong> Your inquiry has been submitted. We'll be in touch shortly.
            </div>
        <?php else : ?>

            <?php if ( ! empty( $errors ) ) : ?>
                <div class="lns-inq-errors" role="alert">
                    <strong>Please fix the following:</strong>
                    <ul>
                        <?php foreach ( $errors as $e ) : ?>
                            <li><?php echo esc_html( $e ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" class="lns-inq-form" novalidate>
                <?php wp_nonce_field( 'lns_inq_submit_action', 'lns_inq_nonce' ); ?>

                <!-- Honeypot – hidden from real users -->
                <div class="lns-inq-hp" aria-hidden="true">
                    <label for="lns_inq_website">Leave this empty</label>
                    <input type="text" name="lns_inq_website" id="lns_inq_website" tabindex="-1" autocomplete="off" />
                </div>

                <div class="lns-inq-row">
                    <div class="lns-inq-field">
                        <label for="lns_full_name">Full Name <span class="lns-req">*</span></label>
                        <input type="text" id="lns_full_name" name="lns_full_name"
                               value="<?php echo esc_attr( self::old( 'lns_full_name' ) ); ?>" required />
                    </div>
                    <div class="lns-inq-field">
                        <label for="lns_phone">Phone <span class="lns-req">*</span></label>
                        <input type="tel" id="lns_phone" name="lns_phone"
                               value="<?php echo esc_attr( self::old( 'lns_phone' ) ); ?>" required />
                    </div>
                </div>

                <div class="lns-inq-row">
                    <div class="lns-inq-field">
                        <label for="lns_email">Email <span class="lns-req">*</span></label>
                        <input type="email" id="lns_email" name="lns_email"
                               value="<?php echo esc_attr( self::old( 'lns_email' ) ); ?>" required />
                    </div>
                    <div class="lns-inq-field">
                        <label for="lns_address">Address / City</label>
                        <input type="text" id="lns_address" name="lns_address"
                               value="<?php echo esc_attr( self::old( 'lns_address' ) ); ?>" />
                    </div>
                </div>

                <div class="lns-inq-field">
                    <label for="lns_service">Service Needed <span class="lns-req">*</span></label>
                    <select id="lns_service" name="lns_service" required>
                        <?php foreach ( LNS_Inq_CPT::SERVICES as $val => $label ) : ?>
                            <option value="<?php echo esc_attr( $val ); ?>"
                                <?php selected( self::old( 'lns_service' ), $val ); ?>>
                                <?php echo esc_html( $label ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="lns-inq-field">
                    <label for="lns_message">Message <span class="lns-req">*</span></label>
                    <textarea id="lns_message" name="lns_message" rows="5" required><?php
                        echo esc_textarea( self::old( 'lns_message' ) );
                    ?></textarea>
                </div>

                <fieldset class="lns-inq-field">
                    <legend>Preferred Contact Method <span class="lns-req">*</span></legend>
                    <div class="lns-inq-radios">
                        <?php foreach ( [ 'call' => 'Call', 'text' => 'Text', 'email' => 'Email' ] as $val => $label ) : ?>
                            <label>
                                <input type="radio" name="lns_contact_method" value="<?php echo esc_attr( $val ); ?>"
                                    <?php checked( self::old( 'lns_contact_method' ), $val ); ?> />
                                <?php echo esc_html( $label ); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <div class="lns-inq-field lns-inq-consent">
                    <label>
                        <input type="checkbox" name="lns_consent" value="1"
                            <?php checked( self::old( 'lns_consent' ), '1' ); ?> required />
                        I consent to Lawrence &amp; Sons storing my information and contacting me regarding this inquiry. <span class="lns-req">*</span>
                    </label>
                </div>

                <button type="submit" name="lns_inq_submit" class="lns-inq-btn">
                    Submit Inquiry
                </button>
            </form>

        <?php endif;

        return ob_get_clean();
    }

    /* -------------------------------------------------------------- */
    /*  Process form                                                  */
    /* -------------------------------------------------------------- */
    private static function process_submission() {
        /* Nonce check */
        if ( ! isset( $_POST['lns_inq_nonce'] ) ||
             ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lns_inq_nonce'] ) ), 'lns_inq_submit_action' ) ) {
            return [ 'Security check failed. Please try again.' ];
        }

        /* Honeypot check */
        if ( ! empty( $_POST['lns_inq_website'] ) ) {
            /* Silently reject bots but show success so they move on. */
            return true;
        }

        /* Sanitize */
        $full_name      = sanitize_text_field( wp_unslash( $_POST['lns_full_name'] ?? '' ) );
        $phone          = sanitize_text_field( wp_unslash( $_POST['lns_phone'] ?? '' ) );
        $email          = sanitize_email( wp_unslash( $_POST['lns_email'] ?? '' ) );
        $address        = sanitize_text_field( wp_unslash( $_POST['lns_address'] ?? '' ) );
        $service        = sanitize_text_field( wp_unslash( $_POST['lns_service'] ?? '' ) );
        $message        = sanitize_textarea_field( wp_unslash( $_POST['lns_message'] ?? '' ) );
        $contact_method = sanitize_text_field( wp_unslash( $_POST['lns_contact_method'] ?? '' ) );
        $consent        = ! empty( $_POST['lns_consent'] ) ? '1' : '';

        /* Validate */
        $errors = [];
        if ( empty( $full_name ) )                          $errors[] = 'Full Name is required.';
        if ( empty( $phone ) )                              $errors[] = 'Phone is required.';
        if ( ! is_email( $email ) )                         $errors[] = 'A valid email is required.';
        if ( empty( $service ) ||
             ! array_key_exists( $service, LNS_Inq_CPT::SERVICES ) ) {
            $errors[] = 'Please select a service.';
        }
        if ( empty( $message ) )                            $errors[] = 'Message is required.';
        if ( ! in_array( $contact_method, [ 'call', 'text', 'email' ], true ) ) {
            $errors[] = 'Please choose a preferred contact method.';
        }
        if ( $consent !== '1' )                             $errors[] = 'You must consent before submitting.';

        if ( ! empty( $errors ) ) {
            return $errors;
        }

        /* Create CPT post */
        $date_str = current_time( 'Y-m-d' );
        $title    = sprintf( 'Inquiry - %s - %s', $full_name, $date_str );

        $post_id = wp_insert_post( [
            'post_type'   => 'inquiry',
            'post_title'  => $title,
            'post_status' => 'publish',
        ] );

        if ( is_wp_error( $post_id ) ) {
            return [ 'Something went wrong. Please try again later.' ];
        }

        /* Store meta */
        update_post_meta( $post_id, '_lns_full_name',      $full_name );
        update_post_meta( $post_id, '_lns_phone',           $phone );
        update_post_meta( $post_id, '_lns_email',           $email );
        update_post_meta( $post_id, '_lns_address',         $address );
        update_post_meta( $post_id, '_lns_service',         $service );
        update_post_meta( $post_id, '_lns_message',         $message );
        update_post_meta( $post_id, '_lns_contact_method',  $contact_method );
        update_post_meta( $post_id, '_lns_consent',         $consent );
        update_post_meta( $post_id, '_lns_status',          'new' );

        /* Send notification email */
        do_action( 'lns_inq_new_inquiry', $post_id );

        return true;
    }

    /* -------------------------------------------------------------- */
    /*  Helper: repopulate fields on validation failure               */
    /* -------------------------------------------------------------- */
    private static function old( string $key ): string {
        if ( ! isset( $_POST['lns_inq_submit'] ) ) {
            return '';
        }
        return sanitize_text_field( wp_unslash( $_POST[ $key ] ?? '' ) );
    }
}
