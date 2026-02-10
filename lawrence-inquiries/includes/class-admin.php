<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Admin customizations: columns, filters, metabox, row actions.
 */
final class LNS_Inq_Admin {

    public static function init(): void {
        /* Custom columns */
        add_filter( 'manage_inquiry_posts_columns',       [ __CLASS__, 'set_columns' ] );
        add_action( 'manage_inquiry_posts_custom_column',  [ __CLASS__, 'render_column' ], 10, 2 );
        add_filter( 'manage_edit-inquiry_sortable_columns', [ __CLASS__, 'sortable_columns' ] );

        /* Status filter dropdown */
        add_action( 'restrict_manage_posts', [ __CLASS__, 'status_filter_dropdown' ] );
        add_action( 'pre_get_posts',         [ __CLASS__, 'apply_status_filter' ] );

        /* Metabox on edit screen */
        add_action( 'add_meta_boxes', [ __CLASS__, 'add_meta_boxes' ] );
        add_action( 'save_post_inquiry', [ __CLASS__, 'save_meta_box' ] );

        /* Row actions */
        add_filter( 'post_row_actions', [ __CLASS__, 'row_actions' ], 10, 2 );
        add_action( 'admin_init', [ __CLASS__, 'handle_mark_contacted' ] );

        /* Admin styles */
        add_action( 'admin_head', [ __CLASS__, 'admin_css' ] );
    }

    /* ============================================================== */
    /*  COLUMNS                                                       */
    /* ============================================================== */
    public static function set_columns( array $columns ): array {
        $new = [];
        $new['cb']           = $columns['cb'];
        $new['title']        = 'Inquiry';
        $new['lns_name']     = 'Name';
        $new['lns_phone']    = 'Phone';
        $new['lns_email']    = 'Email';
        $new['lns_service']  = 'Service';
        $new['lns_status']   = 'Status';
        $new['date']         = 'Date';
        return $new;
    }

    public static function render_column( string $column, int $post_id ): void {
        switch ( $column ) {
            case 'lns_name':
                echo esc_html( get_post_meta( $post_id, '_lns_full_name', true ) );
                break;
            case 'lns_phone':
                $phone = get_post_meta( $post_id, '_lns_phone', true );
                echo '<a href="tel:' . esc_attr( $phone ) . '">' . esc_html( $phone ) . '</a>';
                break;
            case 'lns_email':
                $email = get_post_meta( $post_id, '_lns_email', true );
                echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
                break;
            case 'lns_service':
                $key = get_post_meta( $post_id, '_lns_service', true );
                echo esc_html( LNS_Inq_CPT::SERVICES[ $key ] ?? $key );
                break;
            case 'lns_status':
                $key   = get_post_meta( $post_id, '_lns_status', true ) ?: 'new';
                $label = LNS_Inq_CPT::STATUSES[ $key ] ?? $key;
                $color = self::status_color( $key );
                printf(
                    '<span class="lns-status-badge" style="background:%s;">%s</span>',
                    esc_attr( $color ),
                    esc_html( $label )
                );
                break;
        }
    }

    public static function sortable_columns( array $columns ): array {
        $columns['lns_name'] = 'lns_name';
        $columns['date']     = 'date';
        return $columns;
    }

    /* ============================================================== */
    /*  STATUS FILTER                                                 */
    /* ============================================================== */
    public static function status_filter_dropdown(): void {
        global $typenow;
        if ( $typenow !== 'inquiry' ) {
            return;
        }
        $current = sanitize_text_field( $_GET['lns_status_filter'] ?? '' );
        echo '<select name="lns_status_filter">';
        echo '<option value="">All Statuses</option>';
        foreach ( LNS_Inq_CPT::STATUSES as $val => $label ) {
            printf(
                '<option value="%s" %s>%s</option>',
                esc_attr( $val ),
                selected( $current, $val, false ),
                esc_html( $label )
            );
        }
        echo '</select>';
    }

    public static function apply_status_filter( \WP_Query $query ): void {
        if ( ! is_admin() || ! $query->is_main_query() ) {
            return;
        }
        if ( ( $query->get( 'post_type' ) !== 'inquiry' ) ) {
            return;
        }
        $filter = sanitize_text_field( $_GET['lns_status_filter'] ?? '' );
        if ( $filter !== '' && array_key_exists( $filter, LNS_Inq_CPT::STATUSES ) ) {
            $query->set( 'meta_key', '_lns_status' );
            $query->set( 'meta_value', $filter );
        }
    }

    /* ============================================================== */
    /*  METABOX (edit screen)                                         */
    /* ============================================================== */
    public static function add_meta_boxes(): void {
        add_meta_box(
            'lns_inquiry_details',
            'Inquiry Details',
            [ __CLASS__, 'render_meta_box' ],
            'inquiry',
            'normal',
            'high'
        );
        add_meta_box(
            'lns_inquiry_status_box',
            'Inquiry Status',
            [ __CLASS__, 'render_status_box' ],
            'inquiry',
            'side',
            'high'
        );
    }

    public static function render_meta_box( \WP_Post $post ): void {
        $fields = [
            '_lns_full_name'      => 'Full Name',
            '_lns_phone'          => 'Phone',
            '_lns_email'          => 'Email',
            '_lns_address'        => 'Address / City',
            '_lns_service'        => 'Service Needed',
            '_lns_message'        => 'Message',
            '_lns_contact_method' => 'Preferred Contact',
        ];
        echo '<table class="form-table lns-inq-detail-table">';
        foreach ( $fields as $key => $label ) {
            $val = get_post_meta( $post->ID, $key, true );
            if ( $key === '_lns_service' ) {
                $val = LNS_Inq_CPT::SERVICES[ $val ] ?? $val;
            }
            printf(
                '<tr><th>%s</th><td>%s</td></tr>',
                esc_html( $label ),
                $key === '_lns_message' ? nl2br( esc_html( $val ) ) : esc_html( $val )
            );
        }
        echo '</table>';
    }

    public static function render_status_box( \WP_Post $post ): void {
        wp_nonce_field( 'lns_inq_status_save', 'lns_inq_status_nonce' );
        $current = get_post_meta( $post->ID, '_lns_status', true ) ?: 'new';
        echo '<select name="lns_inq_status" style="width:100%">';
        foreach ( LNS_Inq_CPT::STATUSES as $val => $label ) {
            printf(
                '<option value="%s" %s>%s</option>',
                esc_attr( $val ),
                selected( $current, $val, false ),
                esc_html( $label )
            );
        }
        echo '</select>';
    }

    public static function save_meta_box( int $post_id ): void {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( ! isset( $_POST['lns_inq_status_nonce'] ) ||
             ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lns_inq_status_nonce'] ) ), 'lns_inq_status_save' ) ) {
            return;
        }
        $status = sanitize_text_field( wp_unslash( $_POST['lns_inq_status'] ?? '' ) );
        if ( array_key_exists( $status, LNS_Inq_CPT::STATUSES ) ) {
            update_post_meta( $post_id, '_lns_status', $status );
        }
    }

    /* ============================================================== */
    /*  ROW ACTIONS – "Mark Contacted"                                */
    /* ============================================================== */
    public static function row_actions( array $actions, \WP_Post $post ): array {
        if ( $post->post_type !== 'inquiry' ) {
            return $actions;
        }
        $current = get_post_meta( $post->ID, '_lns_status', true );
        if ( $current === 'new' ) {
            $url = wp_nonce_url(
                add_query_arg( [
                    'action'  => 'lns_mark_contacted',
                    'post_id' => $post->ID,
                ], admin_url( 'admin.php' ) ),
                'lns_mark_contacted_' . $post->ID
            );
            $actions['lns_contacted'] = sprintf(
                '<a href="%s" style="color:#1F4D3A;font-weight:600;">Mark Contacted</a>',
                esc_url( $url )
            );
        }
        return $actions;
    }

    public static function handle_mark_contacted(): void {
        if ( ( $_GET['action'] ?? '' ) !== 'lns_mark_contacted' ) {
            return;
        }
        $post_id = absint( $_GET['post_id'] ?? 0 );
        if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
            wp_die( 'Unauthorized.' );
        }
        check_admin_referer( 'lns_mark_contacted_' . $post_id );
        update_post_meta( $post_id, '_lns_status', 'contacted' );

        wp_safe_redirect( admin_url( 'edit.php?post_type=inquiry&lns_updated=1' ) );
        exit;
    }

    /* ============================================================== */
    /*  Admin CSS                                                     */
    /* ============================================================== */
    public static function admin_css(): void {
        $screen = get_current_screen();
        if ( ! $screen || $screen->post_type !== 'inquiry' ) {
            return;
        }
        ?>
        <style>
            .lns-status-badge {
                display:inline-block;padding:3px 10px;border-radius:12px;
                color:#fff;font-size:12px;font-weight:600;line-height:1.4;
            }
            .lns-inq-detail-table th { width:160px;font-weight:600; }
            .lns-inq-detail-table td { padding:8px 10px; }
        </style>
        <?php
    }

    /* ============================================================== */
    /*  Helpers                                                       */
    /* ============================================================== */
    private static function status_color( string $key ): string {
        return match ( $key ) {
            'new'           => '#2271b1',
            'contacted'     => '#dba617',
            'estimate_sent' => '#1F4D3A',
            'won'           => '#00a32a',
            'lost'          => '#b32d2e',
            default         => '#666',
        };
    }
}
