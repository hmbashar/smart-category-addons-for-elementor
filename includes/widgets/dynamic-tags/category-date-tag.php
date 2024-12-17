<?php
namespace SmartCategoryAddons\DynamicTags;

use Elementor\Core\DynamicTags\Tag;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Date_Tag extends Tag {
    public function get_name() {
        return 'category_date';
    }

    public function get_title() {
        return esc_html__( 'Category Date', 'smart-category-addons' );
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
            $term_id = $categories[0]->term_id;
    
            // Get the latest post in this category
            $latest_post = get_posts( [
                'category'    => $term_id,
                'numberposts' => 1,
                'orderby'     => 'post_modified',
                'order'       => 'DESC',
            ] );
    
            if ( ! empty( $latest_post ) ) {
                $post_date = $latest_post[0]->post_modified; // Post's modified date
                echo esc_html( date( 'F j, Y', strtotime( $post_date ) ) );
            } else {
                echo esc_html__( 'No Posts in Category', 'smart-category-addons' );
            }
        } else {
            echo esc_html__( 'No Categories Available', 'smart-category-addons' );
        }
    }
    
}