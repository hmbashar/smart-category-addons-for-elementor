<?php
/*
Plugin Name: Smart Category Addons for Elementor
Plugin URI: https://github.com/hmbashar/smart-category-addons-for-elementor
Description: A WordPress plugin that provides two custom Elementor widgets: "Category Title" and "Category Description," designed to enhance category-based content display.
Version: 1.0.0
Author: Md Abul Bashar
Author URI: https://hmbashar.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: smart-category-addons
Domain Path: /languages
Requires at least: 5.8
Tested up to: 6.7.1
Requires PHP: 8.0
Tags: Elementor, categories, widgets, WordPress, Elementor Addons
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define( 'SMART_CATEGORY_ADDONS_VERSION', '1.0.0' );
define( 'SMART_CATEGORY_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'SMART_CATEGORY_ADDONS_URL', plugin_dir_url( __FILE__ ) );
define( 'SMART_CATEGORY_ADDONS_INC', SMART_CATEGORY_ADDONS_PATH . 'includes/' );

// Include the main plugin file
require_once SMART_CATEGORY_ADDONS_INC . 'plugin.php';
// Initialize the plugin
\SmartCategoryAddons\Plugin::instance();

// Enqueue plugin styles
function smart_category_addons_enqueue_styles() {
    wp_enqueue_style(
        'smart-category-addons-style',
        SMART_CATEGORY_ADDONS_URL . 'assets/css/style.css',
        [],
        SMART_CATEGORY_ADDONS_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'smart_category_addons_enqueue_styles' );
