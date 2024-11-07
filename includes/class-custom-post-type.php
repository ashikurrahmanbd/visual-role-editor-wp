<?php

class Class_vrewp_custom_post_type{


    public static function cpt_init(){

        add_action( 'init', [__CLASS__, 'vrewp_custom_post_type_register'] );


        add_filter( 'post_row_actions', [__CLASS__, 'vrewp_remove_view_link'] , 10, 2);


        add_action('edit_form_after_title', [__CLASS__, 'vrewp_custom_meta_box']);


        add_action('save_post', [__CLASS__, 'vrewp_save_dropped_capabilities']);

      

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

    //removing view linkk
    public static function vrewp_remove_view_link($actions, $post){

        //actions is an array here and hte $post is the object
        if($post->post_type === 'vrewp_role'){

            unset($actions['view']);

        }

        return $actions;

    }

    

    //display some cusstom html view after title
    public static function vrewp_custom_meta_box($post){


        if($post->post_type === 'vrewp_role') :
        ?> 

            
        <div class="drag-drop-caps">
            <h2>Add Capabilites</h2>

            <div class="vrewp-draggable-caps">

                <input type="button" value="switch_themes"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_themes"  class="draggable-cap" draggable="true">


                <input type="button" value="edit_plugins"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_users"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_files"  class="draggable-cap" draggable="true">


            </div>

            <div class="vrewp-caps-dropped-area" id="drop-area">

                <!-- <h2>Drop Capabilites You need to assign for this Role</h2> -->

                <?php 

                    
                    $dropped_capabilities = get_post_meta(49, '_vrewp_dropped_capabilities', true);

                



                    echo "<pre>";
                    print_r($dropped_capabilities);
                    echo "</pre>";

                
                ?>

            </div>

        </div>
        
        <?php

        endif;

    }

    // function for save meta values to the post
    public static function vrewp_save_dropped_capabilities($post_id) {

        // Check if our hidden input exists and is set
        if (isset($_POST['vrewp_dropped_values'])) {

            // Decode JSON to PHP array
            $dropped_values = json_decode(stripslashes($_POST['vrewp_dropped_values']), true);
    
            // Save as post meta
            if (is_array($dropped_values)) {

                update_post_meta($post_id, '_vrewp_dropped_capabilities', $dropped_values);

            }

        }

    }



}