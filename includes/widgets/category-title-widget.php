<?php
namespace SmartCategoryAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Category_Title_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'category_title';
    }

    public function get_title()
    {
        return esc_html__('Category Title', 'smart-category-addons');
    }

    public function get_icon()
    {
        return 'eicon-editor-bold';
    }

    public function get_categories()
    {
        return ['theme-elements-single'];
    }
    protected function register_controls()
    {
       // Content Tab
        // $this->start_controls_section(
        //     'content_section',
        //     [
        //         'label' => esc_html__('Content', 'smart-category-addons'),
        //         'tab' => Controls_Manager::TAB_CONTENT,
        //     ]
        // );

 
        
        // $this->end_controls_section();
        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Category Title', 'smart-category-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Color Control
        $this->add_control(
            'category_title_color',
            [
                'label' => esc_html__('Text Color', 'smart-category-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-title .category-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Hover Color Control
        $this->add_control(
            'category_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'smart-category-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-title .category-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_title_typography',
                'label' => esc_html__('Typography', 'smart-category-addons'),
                'selector' => '{{WRAPPER}} .category-title .category-link',
            ]
        );

        // Text Shadow Control
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'category_title_text_shadow',
                'label' => esc_html__('Text Shadow', 'smart-category-addons'),
                'selector' => '{{WRAPPER}} .category-title .category-link',
            ]
        );

        // Margin Control
        $this->add_responsive_control(
            'category_title_margin',
            [
                'label' => esc_html__('Margin', 'smart-category-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .category-title .category-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'category_title_padding',
            [
                'label' => esc_html__('Padding', 'smart-category-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .category-title .category-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Get the current post's categories
        $categories = get_the_category();

        if (!empty($categories) && is_array($categories)) {
            // Display the first category only
            $category = $categories[0];
            echo '<p class="category-title">';
            echo '<span class="category-link">';
            echo esc_html($category->name);
            echo '</span>';
            echo '</p>';
        } else {
            echo '<p class="category-title">' . esc_html__('Uncategorized', 'smart-category-addons') . '</p>';
        }
    }
}