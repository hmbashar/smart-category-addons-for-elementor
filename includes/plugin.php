<?php
namespace SmartCategoryAddons;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

final class Plugin {
    const VERSION = SMART_CATEGORY_ADDONS_VERSION;
    const MINIMUM_ELEMENTOR_VERSION = '3.20.0';
    const MINIMUM_PHP_VERSION = '8.0';

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        if ( $this->is_compatible() ) {
            add_action( 'elementor/init', [ $this, 'init' ] );
        }
    }

    private function is_compatible() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
            return false;
        }

        if ( version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return false;
        }

        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return false;
        }

        return true;
    }

    public function init() {
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
    }

    public function register_widgets( $widgets_manager ) {
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/category-title-widget.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/category-description-widget.php';

        $widgets_manager->register( new Widgets\Category_Title_Widget() );
        $widgets_manager->register( new Widgets\Category_Description_Widget() );
    }

    public function admin_notice_missing_elementor() {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo esc_html__( 'Smart Category Addons requires Elementor to be installed and activated.', 'smart-category-addons' );
        echo '</p></div>';
    }

    public function admin_notice_minimum_elementor_version() {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo sprintf(
            esc_html__( 'Smart Category Addons requires Elementor version %s or greater.', 'smart-category-addons' ),
            self::MINIMUM_ELEMENTOR_VERSION
        );
        echo '</p></div>';
    }

    public function admin_notice_minimum_php_version() {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo sprintf(
            esc_html__( 'Smart Category Addons requires PHP version %s or greater.', 'smart-category-addons' ),
            self::MINIMUM_PHP_VERSION
        );
        echo '</p></div>';
    }
}