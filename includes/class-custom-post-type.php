<?php

class Class_vrewp_custom_post_type{


    public static function cpt_init(){

        add_action( 'init', [__CLASS__, 'vrewp_custom_post_type_register'] );


        add_filter( 'post_row_actions', [__CLASS__, 'vrewp_remove_view_link'] , 10, 2);


        add_action('edit_form_after_title', [__CLASS__, 'vrewp_custom_meta_box']);


        add_action('save_post', [__CLASS__, 'vrewp_save_dropped_capabilities']);


        add_action('before_trash_post', [__CLASS__, 'vrewp_reassign_users_on_role_trash'], 10, 1);


        add_action('before_delete_post', [__CLASS__, 'vrewp_cleanup_role_on_delete']);

      

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

            <div class="vrewp-draggable-caps" id="vrewp-draggable-caps">

                <input type="button" value="switch_themes"  class="draggable-cap" draggable="true" draggable="true">

                <input type="button" value="edit_themes"  class="draggable-cap" draggable="true" draggable="true">


                <input type="button" value="edit_plugins"  class="draggable-cap" draggable="true" draggable="true">

                <input type="button" value="edit_users"  class="draggable-cap" draggable="true" draggable="true">

                <input type="button" value="edit_files"  class="draggable-cap" draggable="true" draggable="true">

                <input type="button" value="moderate_comments"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_options"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_categories"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_links"  class="draggable-cap" draggable="true">

                <input type="button" value="upload_files"  class="draggable-cap" draggable="true">

                <input type="button" value="import"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_others_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="publish_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="read"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_others_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_published_pages"  class="draggable-cap" draggable="true">


                <input type="button" value="publish_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_pages"  class="draggable-cap" draggable="true">


                <input type="button" value="delete_others_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_published_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_others_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_published_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_private_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_private_posts"  class="draggable-cap" draggable="true">


                <input type="button" value="read_private_posts"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_private_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_private_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="read_private_pages"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_users"  class="draggable-cap" draggable="true">

                <input type="button" value="create_users"  class="draggable-cap" draggable="true">

                <input type="button" value="unfiltered_upload"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_dashboard"  class="draggable-cap" draggable="true">

                <input type="button" value="update_plugins"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_plugins"  class="draggable-cap" draggable="true">

                <input type="button" value="install_plugins"  class="draggable-cap" draggable="true">

                <input type="button" value="install_themes"  class="draggable-cap" draggable="true">

                <input type="button" value="update_core"  class="draggable-cap" draggable="true">

                <input type="button" value="list_users"  class="draggable-cap" draggable="true">

                <input type="button" value="remove_users"  class="draggable-cap" draggable="true">

                <input type="button" value="promote_users"  class="draggable-cap" draggable="true">

                <input type="button" value="edit_theme_options"  class="draggable-cap" draggable="true">

                <input type="button" value="delete_themes"  class="draggable-cap" draggable="true">

                <input type="button" value="export"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_zip_ai_assistant"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_zip_ai_assistant"  class="draggable-cap" draggable="true">

                <input type="button" value="manage_ast_block_templates"  class="draggable-cap" draggable="true">


            </div>

            <div class="vrewp-caps-dropped-area" id="drop-area">

                <!-- <h2>Drop Capabilites You need to assign for this Role</h2> -->
                
                <?php 

                   

                    // Retrieve post meta data
                    $post_meta_data = get_post_meta($post->ID, '_dragged_capabilities', true);

                    // Initialize $clean_array to an empty array to avoid undefined variable error
                    $clean_array = [];

                    if (!empty($post_meta_data)) {
                        // Process data with the function and ensure it returns an array
                        $clean_array = self::vrewp_processed_dropped_caps($post_meta_data);

                        // Check if $clean_array is valid and not empty
                        if (is_array($clean_array) && !empty($clean_array)) {
                            foreach ($clean_array as $single_input) : ?>
                                <input type="button" value="<?php echo htmlspecialchars($single_input); ?>" class="draggable-cap" draggable="true">
                            <?php endforeach; 
                        } else {
                            // Debugging output
                            echo "Error: `vrewp_processed_dropped_caps` did not return a valid array.";
                        }
                    }

                    
                
                ?>



            </div>

            <div class="normal-area">
            
                <?php 

                    // $post_meta_data = get_post_meta( 84, '_dragged_capabilities', true );

                    // $clean_array = self::vrewp_processed_dropped_caps($post_meta_data);

                    // echo "<pre>";
                    // print_r($clean_array);
                    // echo "</pre>";

                
                ?>

            </div>

        </div>
        
        <?php

        endif;

    }

    public static function vrewp_save_dropped_capabilities($post_id) {
        // Ensure you're updating the correct post type
        if (get_post_type($post_id) != 'vrewp_role') {
            return;
        }
    
        // Check if we're doing an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
    
        // Make sure we have new dragged values
        if (isset($_POST['vrewp_dropped_values'])) {
    
            // Decode JSON data and ensure it's a valid array
            $dropped_values = json_decode(stripslashes($_POST['vrewp_dropped_values']), true);
    
            if (is_array($dropped_values)) {
                // Remove any empty values
                $dropped_values = array_filter($dropped_values, function($value) {
                    return $value !== ''; // Exclude empty strings
                });
    
                // Get existing values, ensuring it's an array
                $existing_values = get_post_meta($post_id, '_dragged_capabilities', true);
                $existing_values = is_array($existing_values) ? $existing_values : [];
    
                // Merge without duplicates
                $combined_values = array_unique(array_merge($existing_values, $dropped_values));
    
                // Update the meta with clean combined values
                update_post_meta($post_id, '_dragged_capabilities', $combined_values);
    
                // Create custom role based on post meta
                self::create_role_from_post_meta($post_id, $combined_values);
    
            } else {
    
                // If no valid values, clear the post meta
                delete_post_meta($post_id, '_dragged_capabilities');
    
            }
        }
    }
    
    // Function to create a custom role and assign capabilities
    public static function create_role_from_post_meta($post_id, $capabilities) {
        // Retrieve the role name and slug from the post (you can modify this as needed)
        $role_name = get_the_title($post_id);  // Using post title as the role name
        $role_slug = sanitize_title($role_name);  // Slug can be based on the role name
    
        // Check if the role already exists
        if (!get_role($role_slug)) {
            // Create the role if it doesn't exist
            $role = add_role(
                $role_slug,             // Role slug
                $role_name,             // Role name
                []                       // Default capabilities (empty array means no default capabilities)
            );
    
            // If the role is successfully created, add capabilities to it
            if ($role) {
                foreach ($capabilities as $capability) {
                    // Add the individual capabilities to the role
                    $role->add_cap($capability);
                }
            }
        }
    }


    //trash a role whiile deleting a role posst
    
    // Hook into the 'before_trash_post' action to handle the role deletion

    public static function vrewp_reassign_users_on_role_trash($post_id) {

        $role_name = get_the_title($post_id);  // Using post title as the role name
        $role_slug = sanitize_title($role_name); 

        // Check if the post type is 'vrewp_role' (the custom post type for roles)
        if (get_post_type($post_id) != 'vrewp_role') {
            return;
        }

        // Get the role slug from the post meta (assuming '_role_slug' stores the slug)
        $role_slug = get_post_meta($post_id, $role_slug, true);
        if (!$role_slug) {
            return;
        }

        // Fallback role to assign users to when the role is deleted
        $fallback_role_slug = 'subscriber'; // You can change this to your desired fallback role

        // Get all users with the current role
        $users = get_users(array(
            'role' => $role_slug,
            'fields' => array('ID'), // Retrieve only the user IDs to minimize data load
        ));

        // Reassign each user to the fallback role
        foreach ($users as $user) {
            $wp_user = new WP_User($user->ID);
            $wp_user->remove_role($role_slug); // Remove the custom role
            $wp_user->add_role($fallback_role_slug); // Assign the fallback role
        }

        // After users are reassigned, we can safely remove the role
        remove_role($role_slug);
    }

    //clean meta data as well
    public static function vrewp_cleanup_role_on_delete($post_id) {

        $role_name = get_the_title($post_id);  // Using post title as the role name
        $role_slug = sanitize_title($role_name); 

        // Check if the post type is 'vrewp_role'
        if (get_post_type($post_id) != 'vrewp_role') {
            return;
        }
    
        // Get the role slug from the post meta
        $role_slug = get_post_meta($post_id, $role_slug, true);
        if (!$role_slug) {
            return;
        }
    
        // Delete associated post meta data for the role
        delete_post_meta($post_id, $role_slug);  // Role slug meta
        delete_post_meta($post_id, '_dragged_capabilities');  // Role capabilities meta (if exists)
    
        // Perform any additional cleanup if necessary
        // Example: You could also remove any other custom meta associated with this role
    }





    //returning a clean array of capabilities
    public static function vrewp_processed_dropped_caps($data_array){

        $flat_array = [];

        //Ensure its an array, if its an object then cast it into array
        if (is_object($data_array)) {

            $data_array = (array) $data_array;

        }


        // Loop through and process each element
        foreach ($data_array as $key => $array_value) {

            // Check if the value is a string that looks like a serialized array
            if (is_string($array_value) && (substr($array_value, 0, 1) === '[' && substr($array_value, -1) === ']')) {

                // Decode the JSON string to convert it into an array if it represents one
                $array_value = json_decode($array_value, true);

            }

            // Skip if the item is now an array (nested array)
            if (is_array($array_value)) {

                continue;

            }

            // Only add non-array values to the flat array
            $flat_array[] = $array_value;

        }

        return array_filter($flat_array, function($value){

            return !is_null($value) && $value !== '';

        });


    }


    






}