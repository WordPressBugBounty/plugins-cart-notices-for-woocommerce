<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/ModuleRenderer.php';
require_once __DIR__ . '/Module.php';

function brcn_divi5_register_modules( $dependency_tree ) {
    $dependency_tree->add_dependency( new BRCN_Divi5_Module() );
}
