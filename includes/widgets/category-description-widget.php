<?php
namespace SmartCategoryAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Description_Widget extends Widget_Base {
    public function get_name() {
        return 'category_description';
    }

    public function get_title() {
        return esc_html__( 'Category Description', 'smart-category-addons' );
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        $description = category_description();
        echo '<div class="category-description">' . wp_kses_post( $description ) . '</div>';
    }
}