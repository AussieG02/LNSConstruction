<?php
/**
 * Plugin Name: Lawrence & Sons Inquiries
 * Description: Custom "Get a Quote" inquiry system with admin inbox, status management, and email notifications.
 * Version:     1.0.0
 * Author:      Lawrence & Sons
 * Text Domain: lawrence-inquiries
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LNS_INQ_VERSION', '1.0.0' );
define( 'LNS_INQ_PATH', plugin_dir_path( __FILE__ ) );
define( 'LNS_INQ_URL', plugin_dir_url( __FILE__ ) );

/* ------------------------------------------------------------------ */
/*  Autoload includes                                                 */
/* ------------------------------------------------------------------ */
require_once LNS_INQ_PATH . 'includes/class-cpt.php';
require_once LNS_INQ_PATH . 'includes/class-form.php';
require_once LNS_INQ_PATH . 'includes/class-admin.php';
require_once LNS_INQ_PATH . 'includes/class-notifications.php';
require_once LNS_INQ_PATH . 'includes/class-settings.php';

/* ------------------------------------------------------------------ */
/*  Boot                                                              */
/* ------------------------------------------------------------------ */
function lns_inq_boot(): void {
    LNS_Inq_CPT::init();
    LNS_Inq_Form::init();
    LNS_Inq_Admin::init();
    LNS_Inq_Notifications::init();
    LNS_Inq_Settings::init();
}
add_action( 'plugins_loaded', 'lns_inq_boot' );

/* ------------------------------------------------------------------ */
/*  Activation – flush rewrite rules so CPT permalinks work           */
/* ------------------------------------------------------------------ */
function lns_inq_activate(): void {
    LNS_Inq_CPT::register_post_type();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'lns_inq_activate' );

/* ------------------------------------------------------------------ */
/*  Deactivation                                                      */
/* ------------------------------------------------------------------ */
function lns_inq_deactivate(): void {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'lns_inq_deactivate' );
