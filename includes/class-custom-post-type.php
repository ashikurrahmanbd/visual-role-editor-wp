<?php

class Class_vrewp_custom_post_type{


    public static function cpt_init(){

        add_action( 'init', [__CLASS__, 'vrewp_custom_post_type_register'] );

    }


    public static function vrewp_custom_post_type_register(){

        $vewwp_cpt_args = [
            'labels' => [
                'name'          => 'Roles',
                'singular_name' => 'Role',
                'add_new_item'  => 'Add New Role',
                'edit_item'     => 'Edit Role',
            ],
            'public'      => true,
            'has_archive' => true,
            'menu_position' => null,
            'show_in_menu' => 'vrewp-configure', // Add under custom menu slug
            'supports'    => [ 'title' ],
        ];
    
        register_post_type( 'vrewp_role', $vewwp_cpt_args );

    }


}