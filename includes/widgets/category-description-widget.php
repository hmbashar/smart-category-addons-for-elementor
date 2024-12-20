<?php
namespace SmartCategoryAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Category_Description_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'category_description';
    }

    public function get_title()
    {
        return esc_html__('Category Description', 'smart-category-addons');
    }

    public function get_icon()
    {
        return 'eicon-text-area';
    }

    public function get_categories()
    {
        return ['theme-elements-single'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Settings', 'smart-category-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'max_categories',
            [
                'label' => esc_html__('Number of Categories', 'smart-category-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 1,
                'step' => 1,
                'description' => esc_html__('Set the maximum number of categories to display with descriptions.', 'smart-category-addons'),
            ]
        );

        $this->end_controls_section();

        // Style Tab for Title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Title', 'smart-category-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'smart-category-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'smart-category-addons'),
                'selector' => '{{WRAPPER}} .category-name',
            ]
        );

        $this->end_controls_section();

        // Style Tab for Description
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Description', 'smart-category-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'smart-category-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'smart-category-addons'),
                'selector' => '{{WRAPPER}} .category-description, {{WRAPPER}} .category-description p',
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        // Get the user-defined maximum number of categories
        $settings = $this->get_settings_for_display();
        $max_categories = !empty($settings['max_categories']) ? (int) $settings['max_categories'] : 3;

        // Get the current post's categories
        $categories = get_the_category();

        if (!empty($categories) && is_array($categories)) {
            echo '<div class="category-descriptions">';

            // Limit the number of categories displayed
            $categories = array_slice($categories, 0, $max_categories);

            foreach ($categories as $category) {
                $description = category_description($category->term_id); // Get category description
                if ($description) {
                    echo '<div class="category-description-item">';
                    //echo '<h3 class="category-name">' . esc_html($category->name) . '</h3>'; // Category name
                    echo '<div class="category-description">' . wp_kses_post($description) . '</div>'; // Category description
                    echo '</div>';
                } else {
                    echo '<div class="category-description-item">';
                   // echo '<h3 class="category-name">' . esc_html($category->name) . '</h3>'; // Category name
                    echo '<p class="category-description">' . esc_html__('No description available.', 'smart-category-addons') . '</p>';
                    echo '</div>';
                }
            }
            echo '</div>';
        } else {
            // Fallback message if no categories or descriptions are available
            echo '<p class="no-category-description">';
            echo esc_html__('No categories or descriptions available.', 'smart-category-addons');
            echo '</p>';
        }
    }
}