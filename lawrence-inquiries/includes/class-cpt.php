<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the "inquiry" Custom Post Type.
 */
final class LNS_Inq_CPT {

    /** Valid status values for inquiries. */
    public const STATUSES = [
        'new'            => 'New',
        'contacted'      => 'Contacted',
        'estimate_sent'  => 'Estimate Sent',
        'won'            => 'Won',
        'lost'           => 'Lost',
    ];

    /** Dropdown options for the "Service Needed" field. */
    public const SERVICES = [
        ''                      => '— Select a service —',
        'siding'                => 'Siding',
        'roofing'               => 'Roofing',
        'gutters'               => 'Gutters',
        'windows_doors'         => 'Windows / Doors',
        'exterior_paint_finish' => 'Exterior Paint / Finish',
        'other'                 => 'Other',
    ];

    public static function init(): void {
        add_action( 'init', [ __CLASS__, 'register_post_type' ] );
    }

    public static function register_post_type(): void {
        $labels = [
            'name'               => 'Inquiries',
            'singular_name'      => 'Inquiry',
            'menu_name'          => 'Inquiries',
            'all_items'          => 'All Inquiries',
            'edit_item'          => 'View Inquiry',
            'search_items'       => 'Search Inquiries',
            'not_found'          => 'No inquiries found.',
            'not_found_in_trash' => 'No inquiries found in Trash.',
        ];

        register_post_type( 'inquiry', [
            'labels'              => $labels,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_icon'           => 'dashicons-email-alt',
            'menu_position'       => 26,
            'supports'            => [ 'title' ],
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'rewrite'             => false,
        ] );
    }
}
