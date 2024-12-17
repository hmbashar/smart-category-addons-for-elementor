<?php
namespace SmartCategoryAddons\DynamicTags;

use Elementor\Core\DynamicTags\Tag;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Time_Tag extends Tag {
    public function get_name() {
        return 'category_time';
    }

    public function get_title() {
        return esc_html__( 'Category Time', 'smart-category-addons' );
    }

    public function get_group() {
        return 'category-group';
    }

    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    public function render() {
        $categories = get_the_category();

        if ( ! empty( $categories ) && is_array( $categories ) ) {
            echo esc_html( get_the_time( 'g:i A' ) ); // Displays the time
        } else {
            echo esc_html__( 'No Time', 'smart-category-addons' );
        }
    }
}