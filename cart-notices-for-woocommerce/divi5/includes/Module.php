<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Framework\Utility\HTMLUtility;
use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\Module\Options\Element\ElementClassnames;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

class BRCN_Divi5_Module extends BRCN_Divi5_Module_Renderer implements DependencyInterface {
    public function load() {
        add_action( 'init', array( $this, 'register_module' ) );
    }

    public function register_module() {
        ModuleRegistration::register_module(
            dirname( __DIR__ ) . '/visual-builder/src/modules/cart-notice',
            array(
                'render_callback' => array( $this, 'render_callback' ),
            )
        );
    }

    public function module_styles( $args ) {
        $elements = $args['elements'];
        Style::add(
            array(
                'id'            => $args['id'],
                'name'          => $args['name'],
                'orderIndex'    => $args['orderIndex'],
                'storeInstance' => $args['storeInstance'],
                'styles'        => array(
                    $elements->style(
                        array(
                            'attrName'   => 'module',
                            'styleProps' => array(
                                'disabledOn' => array(
                                    'disabledModuleVisibility' => $args['settings']['disabledModuleVisibility'] ?? null,
                                ),
                            ),
                        )
                    ),
                    $elements->style( array( 'attrName' => 'notice' ) ),
                ),
            )
        );
    }

    public function module_script_data( $args ) {
        $args['elements']->script_data( array( 'attrName' => 'module' ) );
    }

    public function module_classnames( $args ) {
        $args['classnamesInstance']->add(
            ElementClassnames::classnames(
                array(
                    'attrs' => $args['attrs']['module']['decoration'] ?? array(),
                )
            )
        );
        $args['classnamesInstance']->add( 'et_pb_br_cart_notice' );
    }

    public function render_callback( $attrs, $content, $block, $elements ) {
        $children = HTMLUtility::render(
            array(
                'tag'               => 'div',
                'attributes'        => array( 'class' => 'et_pb_module_inner' ),
                'childrenSanitizer' => 'et_core_esc_previously',
                'children'          => $this->render_module(),
            )
        );

        return Module::render(
            array(
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],
                'attrs'               => $attrs,
                'elements'            => $elements,
                'id'                  => $block->parsed_block['id'],
                'moduleClassName'     => 'et_pb_br_cart_notice',
                'name'                => $block->block_type->name,
                'classnamesFunction'  => array( $this, 'module_classnames' ),
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => array( $this, 'module_styles' ),
                'scriptDataComponent' => array( $this, 'module_script_data' ),
                'children'            => $elements->style_components( array( 'attrName' => 'module' ) ) .
                    $elements->style_components( array( 'attrName' => 'notice' ) ) . $children,
            )
        );
    }
}
