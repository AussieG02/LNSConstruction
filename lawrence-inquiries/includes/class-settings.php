<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin settings page: notification email configuration.
 */
final class LNS_Inq_Settings {

    public static function init(): void {
        add_action( 'admin_menu', [ __CLASS__, 'add_settings_page' ] );
        add_action( 'admin_init', [ __CLASS__, 'register_settings' ] );
    }

    /* -------------------------------------------------------------- */
    /*  Menu item (sub-page under Inquiries)                          */
    /* -------------------------------------------------------------- */
    public static function add_settings_page(): void {
        add_submenu_page(
            'edit.php?post_type=inquiry',
            'Inquiry Settings',
            'Settings',
            'manage_options',
            'lns-inq-settings',
            [ __CLASS__, 'render_page' ]
        );
    }

    /* -------------------------------------------------------------- */
    /*  Register setting                                              */
    /* -------------------------------------------------------------- */
    public static function register_settings(): void {
        register_setting( 'lns_inq_settings_group', 'lns_inq_notification_email', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_email',
            'default'           => get_option( 'admin_email' ),
        ] );

        add_settings_section(
            'lns_inq_notifications_section',
            'Notification Settings',
            function () {
                echo '<p>Configure where new-inquiry notification emails are sent.</p>';
            },
            'lns-inq-settings'
        );

        add_settings_field(
            'lns_inq_notification_email',
            'Notification Email',
            [ __CLASS__, 'render_email_field' ],
            'lns-inq-settings',
            'lns_inq_notifications_section'
        );
    }

    public static function render_email_field(): void {
        $val = get_option( 'lns_inq_notification_email', get_option( 'admin_email' ) );
        printf(
            '<input type="email" name="lns_inq_notification_email" value="%s" class="regular-text" />
             <p class="description">Leave blank to use the site admin email (%s).</p>',
            esc_attr( $val ),
            esc_html( get_option( 'admin_email' ) )
        );
    }

    /* -------------------------------------------------------------- */
    /*  Render page                                                   */
    /* -------------------------------------------------------------- */
    public static function render_page(): void {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap">
            <h1>Inquiry Settings</h1>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'lns_inq_settings_group' );
                    do_settings_sections( 'lns-inq-settings' );
                    submit_button( 'Save Settings' );
                ?>
            </form>
        </div>
        <?php
    }
}
