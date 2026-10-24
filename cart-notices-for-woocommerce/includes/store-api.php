<?php
if( ! defined('ABSPATH') ) {
    exit;
}

class BeRocket_Cart_Notices_Store_API {
    public static $block_page = false;

    public static function init() {
        if( ! function_exists('woocommerce_store_api_register_endpoint_data') ) {
            return;
        }
        woocommerce_store_api_register_endpoint_data(array(
            'endpoint' => \Automattic\WooCommerce\StoreApi\Schemas\V1\CartSchema::IDENTIFIER,
            'namespace' => 'berocket-cart-notices',
            'data_callback' => array(__CLASS__, 'data'),
            'schema_callback' => array(__CLASS__, 'schema'),
            'schema_type' => ARRAY_A,
        ));
        add_action('wp', array(__CLASS__, 'prepare_page'), 20);
        add_filter('render_block', array(__CLASS__, 'render_container'), 10, 2);
    }

    public static function data() {
        $plugin = BeRocket_cart_notices::getInstance();
        // A Store API batch can change the cart more than once within the same PHP request.
        $plugin->reset_notice_progress_totals();
        ob_start();
        $plugin->cart_calculate_total(false);
        return array('automatic' => ob_get_clean(), 'shortcode' => $plugin->shortcode());
    }

    public static function schema() {
        $property = array('type' => 'string', 'readonly' => true, 'context' => array('view'));
        return array('automatic' => $property, 'shortcode' => $property);
    }

    public static function prepare_page() {
        self::$block_page = (is_cart() && has_block('woocommerce/cart'))
            || (is_checkout() && has_block('woocommerce/checkout'));
        if( ! self::$block_page ) {
            return;
        }
        $plugin = BeRocket_cart_notices::getInstance();
        // Block notices are rendered before wp_head. Use our own current-cart container instead.
        remove_action('wp_head', array($plugin, 'wc_notices_page_check'), 10);
        remove_action('wp_head', array($plugin, 'fix_error_duplicate'), 10);
        remove_filter('the_content', array($plugin, 'the_content'));
        global $berocket_cart_notice_add_notice;
        $options = $plugin->get_option();
        $pages = isset($options['wc_notice_pages']) ? (array) $options['wc_notice_pages'] : array();
        $berocket_cart_notice_add_notice = ! $pages || in_array(is_checkout() ? 'checkout' : 'cart', $pages);
        // Discard only this plugin's stale queued notices; preserve WooCommerce and other plugins.
        $notices = wc_get_notices();
        foreach( isset($notices['notice']) ? $notices['notice'] : array() as $key => $notice ) {
            $text = is_array($notice) ? $notice['notice'] : $notice;
            if( strpos($text, '<div class="berocket_cart_notice ') !== false
                || strpos($text, '<span class="berocket_cart_notice') !== false ) {
                unset($notices['notice'][$key]);
            }
        }
        wc_set_notices($notices);
    }

    public static function render_container($content, $block) {
        if( ! self::$block_page || ! in_array($block['blockName'], array('woocommerce/cart', 'woocommerce/checkout')) ) {
            return $content;
        }
        $plugin = BeRocket_cart_notices::getInstance();
        if( ! $plugin->automatic_notices_enabled() ) {
            return $content;
        }
        ob_start();
        $plugin->cart_calculate_total(false);
        // Keep the container outside the DOM owned by the Cart/Checkout React components.
        return '<div class="woocommerce berocket_cart_notice_auto">'.ob_get_clean().'</div>'.$content;
    }
}

add_action('woocommerce_blocks_loaded', array('BeRocket_Cart_Notices_Store_API', 'init'));
if( did_action('woocommerce_blocks_loaded') ) {
    BeRocket_Cart_Notices_Store_API::init();
}
