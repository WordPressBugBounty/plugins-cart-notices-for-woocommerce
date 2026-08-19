<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BRCN_Divi5_Integration {
    public static function init() {
        add_action( 'divi_module_library_modules_dependency_tree', array( __CLASS__, 'register_modules' ) );
        add_action( 'divi_visual_builder_assets_before_enqueue_scripts', array( __CLASS__, 'enqueue_visual_builder_assets' ) );
        add_action( 'wp_ajax_brcn_divi5_preview', array( __CLASS__, 'preview_ajax' ) );
    }

    public static function register_modules( $dependency_tree ) {
        if( ! self::is_enabled() || ! class_exists('ET\\Builder\\Packages\\ModuleLibrary\\ModuleRegistration') ) {
            return;
        }

        require_once __DIR__ . '/loader.php';
        brcn_divi5_register_modules( $dependency_tree );
    }

    public static function enqueue_visual_builder_assets() {
        if( ! self::is_enabled() || ! class_exists('ET\\Builder\\VisualBuilder\\Assets\\PackageBuildManager') ) {
            return;
        }

        $asset_path = dirname( __DIR__ ) . '/visual-builder/build/woocommerce-cart-notices-divi5.js';
        if( ! file_exists( $asset_path ) ) {
            return;
        }

        \ET\Builder\VisualBuilder\Assets\PackageBuildManager::register_package_build(
            array(
                'name'    => 'woocommerce-cart-notices-divi5-visual-builder',
                'version' => BeRocket_cart_notices_version . '-' . filemtime( $asset_path ),
                'script'  => array(
                    'src'                => add_query_arg(
                        array(
                            'brcn_ajax_url' => rawurlencode( admin_url( 'admin-ajax.php' ) ),
                            'brcn_action'   => 'brcn_divi5_preview',
                            'brcn_nonce'    => wp_create_nonce( 'brcn_divi5_preview' ),
                            'brcn_build'    => filemtime( $asset_path ),
                        ),
                        plugin_dir_url( BeRocket_cart_notices_file ) . 'divi5/visual-builder/build/woocommerce-cart-notices-divi5.js'
                    ),
                    'deps'               => array( 'divi-module-library', 'divi-vendor-wp-hooks' ),
                    'enqueue_top_window' => false,
                    'enqueue_app_window' => true,
                ),
            )
        );
    }

    public static function preview_ajax() {
        if( ! self::is_enabled() ) {
            wp_send_json_error( array( 'message' => __( 'Divi 5 is not enabled.', 'cart-notices-for-woocommerce' ) ), 400 );
        }

        if( ! check_ajax_referer( 'brcn_divi5_preview', 'nonce', false ) ) {
            wp_send_json_error( array( 'message' => __( 'Security check failed.', 'cart-notices-for-woocommerce' ) ), 403 );
        }

        if( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) && ! current_user_can( 'edit_theme_options' ) ) {
            wp_send_json_error( array( 'message' => __( 'You do not have permission to preview this module.', 'cart-notices-for-woocommerce' ) ), 403 );
        }

        require_once __DIR__ . '/ModuleRenderer.php';
        $html = '';
        if( function_exists('WC') && is_a(WC()->cart, 'WC_Cart') ) {
            $renderer = new BRCN_Divi5_Module_Renderer();
            $html     = $renderer->render_module();
        }

        if( '' === trim( $html ) ) {
            $html = self::render_example_notices();
        }

        wp_send_json_success( array( 'html' => $html ) );
    }

    private static function render_example_notices() {
        ob_start();
        wc_print_notice(
            '<span class="berocket_cart_notice_shortcode_notice berocket_cart_notice"></span>' .
            esc_html__( 'Notice text example in Divi Builder', 'cart-notices-for-woocommerce' ),
            'notice'
        );
        wc_print_notice(
            '<span class="berocket_cart_notice_shortcode_notice berocket_cart_notice"></span>' .
            esc_html__( 'Second notice text example in Divi Builder', 'cart-notices-for-woocommerce' ),
            'notice'
        );
        $notices = ob_get_clean();

        return '<div class="woocommerce berocket_cart_notice_shortcode">' . $notices . '</div>';
    }

    private static function is_enabled() {
        return function_exists('et_builder_d5_enabled') && et_builder_d5_enabled();
    }
}
