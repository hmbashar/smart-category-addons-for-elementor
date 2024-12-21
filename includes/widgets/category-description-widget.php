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
        // $this->start_controls_section(
        //     'content_section',
        //     [
        //         'label' => esc_html__('Content', 'smart-category-addons'),
        //         'tab' => Controls_Manager::TAB_CONTENT,
        //     ]
        // );


        // $this->end_controls_section();
   

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
        // Get the current post's categories
        $categories = get_the_category();

        if (!empty($categories) && is_array($categories)) {
            // Get the first category
            $category = $categories[0];
            $description = category_description($category->term_id); // Get category description

            echo '<div class="category-description-item">';

            if ($description) {
                echo '<div class="category-description">' . wp_kses_post($description) . '</div>'; // Category description
            } else {
                echo '<p class="category-description">' . esc_html__('No description available.', 'smart-category-addons') . '</p>';
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