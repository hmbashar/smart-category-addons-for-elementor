<?php
namespace SmartCategoryAddons\DynamicTags;

use Elementor\Core\DynamicTags\Tag;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Description_Tag extends Tag {
    public function get_name() {
        return 'category_description';
    }

    public function get_title() {
        return esc_html__( 'Category Description', 'smart-category-addons' );
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
            echo wp_kses_post( category_description( $categories[0]->term_id ) );
        } else {
            echo esc_html__( 'No description available.', 'smart-category-addons' );
        }
    }
}