<?php
namespace SmartCategoryAddons;

use SmartCategoryAddons\DynamicTags\Category_Name_Tag;
use SmartCategoryAddons\DynamicTags\Category_Description_Tag;
use SmartCategoryAddons\DynamicTags\Category_ID_Tag;
use SmartCategoryAddons\DynamicTags\Category_Time_Tag;
use SmartCategoryAddons\DynamicTags\Category_Date_Tag;
use SmartCategoryAddons\DynamicTags\Category_Custom_Field_Tag;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Register_Dynamic_Tags {
    public static function init() {
        add_action( 'elementor/dynamic_tags/register', [ __CLASS__, 'register_tags' ] );
        add_action( 'elementor/dynamic_tags/register', [ __CLASS__, 'register_new_dynamic_tag_group' ]);
    }

    public static function register_tags( $dynamic_tags ) {
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-name-tag.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-description-tag.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-id-tag.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-time-tag.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-date-tag.php';
        require_once SMART_CATEGORY_ADDONS_INC . 'widgets/dynamic-tags/category-custom-field-tag.php';

        $dynamic_tags->register( new Category_Name_Tag() );
        $dynamic_tags->register( new Category_Description_Tag() );
        $dynamic_tags->register( new Category_ID_Tag() );
        $dynamic_tags->register( new Category_Time_Tag() );
        $dynamic_tags->register( new Category_Date_Tag() );
        $dynamic_tags->register( new Category_Custom_Field_Tag() );
    }

    public static function register_new_dynamic_tag_group( $dynamic_tags_manager ) {

        $dynamic_tags_manager->register_group(
            'category-group',
            [
                'title' => esc_html__( 'Category', 'smart-category-addons' )
            ]
        );
    
    }
    
    
}

Register_Dynamic_Tags::init();