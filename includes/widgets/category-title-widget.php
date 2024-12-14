<?php
namespace SmartCategoryAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Title_Widget extends Widget_Base {
    public function get_name() {
        return 'category_title';
    }

    public function get_title() {
        return esc_html__( 'Category Title', 'smart-category-addons' );
    }

    public function get_icon() {
        return 'eicon-editor-bold';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        $title = single_cat_title( '', false );
        echo '<h1 class="category-title">' . esc_html( $title ) . '</h1>';
    }
}