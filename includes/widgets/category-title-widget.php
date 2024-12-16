<?php
namespace SmartCategoryAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

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
    protected function register_controls() {
        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Category Title', 'smart-category-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Color Control
        $this->add_control(
            'category_title_color',
            [
                'label' => esc_html__( 'Text Color', 'smart-category-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Hover Color Control
        $this->add_control(
            'category_title_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'smart-category-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_title_typography',
                'label' => esc_html__( 'Typography', 'smart-category-addons' ),
                'selector' => '{{WRAPPER}} .category-title a',
            ]
        );

        // Text Shadow Control
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'category_title_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'smart-category-addons' ),
                'selector' => '{{WRAPPER}} .category-title a',
            ]
        );

        // Margin Control
        $this->add_responsive_control(
            'category_title_margin',
            [
                'label' => esc_html__( 'Margin', 'smart-category-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'category_title_padding',
            [
                'label' => esc_html__( 'Padding', 'smart-category-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .category-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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