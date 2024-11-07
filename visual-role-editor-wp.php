<?php
/**
 * Plugin Name: Visual Role Editor WP
 * Plugin URI: wordpress.org/plugins/visual-role-editor-wp
 * Author: Ashikur Rahman
 * Author URI: pixelese.com/ashikur-rahman
 * Description: Visual Role editor a special plugin to setup user role by drag and drop
 */

final class Visual_role_editor_wp{

    private static $instance = null;

    const version = '1.0';

    private function __construct(){

        //load dependencies
        $this->vrewp_load_dependendcies();

        //initailze hooks
        $this->vrewp_initialize_hooks();

    }

    public static function vrewp_get_instance(){

        if( self::$instance === null ){

            self::$instance = new self();

        }

        return self::$instance;

    }

    // load dependencies
    private function vrewp_load_dependendcies(){

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-vrewp-settings.php';

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-vrewp-enqueue-assets.php';

        require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-post-type.php';

    }


    //initalize hooks
    private function vrewp_initialize_hooks(){

        Class_vrewp_settings::settings_init();

        Class_vrewp_enqueue_assets::assets_init();

        Class_vrewp_custom_post_type::cpt_init();

    }


}

Visual_role_editor_wp::vrewp_get_instance();