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
        return [ 'theme-elements-single' ];
    }
    protected function render() {
        // Get the current post's categories
        $categories = get_the_category();
        
        if ( ! empty( $categories ) && is_array( $categories ) ) {
            echo '<p class="category-title">';
            foreach ( $categories as $category ) {
                // Escape output for security
                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="category-link">';
                echo esc_html( $category->name );
                echo '</a>';
                
                // Add separator if not the last category
                if ( end( $categories ) !== $category ) {
                    echo ', ';
                }
            }
            echo '</p>';
        } else {
            echo '<p class="category-title">' . esc_html__( 'Uncategorized', 'smart-category-addons' ) . '</p>';
        }
    }
}