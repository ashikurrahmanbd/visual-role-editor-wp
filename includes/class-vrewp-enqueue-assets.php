<?php

class Class_vrewp_enqueue_assets{


    public static function assets_init(){

        add_action( 'admin_enqueue_scripts', [__CLASS__, 'vrewp_assets_enqueue_callback']);

    }

    public static function vrewp_assets_enqueue_callback(){


        wp_enqueue_style( 'vrewp-admin-style', plugin_dir_url(__FILE__) . '../assets/css/admin-style.css', [], filemtime(__FILE__));

    }


}