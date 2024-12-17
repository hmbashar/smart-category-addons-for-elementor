<?php
namespace SmartCategoryAddons\DynamicTags;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Category_Custom_Field_Tag extends Tag {
    public function get_name() {
        return 'category_custom_field';
    }

    public function get_title() {
        return esc_html__( 'Category Custom Field', 'smart-category-addons' );
    }

    public function get_group() {
        return 'category-group'; // Custom group for categories
    }

    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; // Text output
    }

    protected function register_controls() {
        $this->add_control(
            'meta_key',
            [
                'label' => esc_html__( 'Custom Field Key', 'smart-category-addons' ),
                'type'  => Controls_Manager::SELECT,
                'options' => $this->get_category_meta_keys(),
                'description' => esc_html__( 'Select a custom field key to display its value.', 'smart-category-addons' ),
            ]
        );
    }

    /**
     * Fetch all custom field keys (meta keys) for categories.
     */
    private function get_category_meta_keys() {
        global $wpdb;

        // Fetch distinct meta keys from the termmeta table
        $results = $wpdb->get_results("
            SELECT DISTINCT meta_key 
            FROM {$wpdb->termmeta} 
            WHERE meta_key NOT LIKE '\_%'
        ");

        $meta_keys = [];

        if ( ! empty( $results ) ) {
            foreach ( $results as $result ) {
                $meta_keys[ $result->meta_key ] = $result->meta_key;
            }
        }

        return ! empty( $meta_keys ) ? $meta_keys : [ '' => esc_html__( 'No Custom Fields Found', 'smart-category-addons' ) ];
    }

    public function render() {
        $meta_key = $this->get_settings( 'meta_key' );

        // Fetch the first category of the current post
        $categories = get_the_category();

        if ( ! empty( $categories ) && $meta_key ) {
            $category_id = $categories[0]->term_id;

            // Fetch the custom field value
            $meta_value = get_term_meta( $category_id, $meta_key, true );

            if ( ! empty( $meta_value ) ) {
                echo esc_html( $meta_value );
            } else {
                echo esc_html__( 'No value found for the selected custom field.', 'smart-category-addons' );
            }
        } else {
            echo esc_html__( 'No categories available or no field selected.', 'smart-category-addons' );
        }
    }
}