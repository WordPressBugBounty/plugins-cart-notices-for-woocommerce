<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BRCN_Divi5_Module_Renderer {
    public function render_module() {
        return do_shortcode('[br_cart_notices]');
    }
}
