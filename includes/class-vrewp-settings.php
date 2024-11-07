<?php

class Class_vrewp_settings{

    public static function settings_init(){

        add_action( 'admin_menu', [__CLASS__, 'vrewp_settings_menu_page_callack']);

    }


    public static function vrewp_settings_menu_page_callack(){

       

        add_menu_page( 'Visual Role Editor', 'Visual Role Editor', 'manage_options', 'vrewp-configure', [__CLASS__, 'vrewp_settings_page_view_callback'], 'dashicons-privacy'  );

    }


    public static function vrewp_settings_page_view_callback(){

        $wp_users_list = get_users();


        ?>

            <div class="wrap vrewp-settings-page">

                
                <div class="page-primary-action">
                    <h2 class="settings-section-title">Visual Role Editor</h2>
                    <a href="#s" class="">Add New Custom Role</a>
                </div>
              


                <div class="vrewp-users-grid-wrapper">
                    
                    <h3>Available Users</h3>
                   
                    <div class="vrewp-users-grid">

                        <?php foreach($wp_users_list as $user): ?>
                        <div class="vrewp-single-user">
                            <div class="user-details">
                                <?php 

                                    $user_avatar = get_avatar( $user->ID, 60, '', '', array( 'class' => 'wrewp-user-image' ));

                                    if($user_avatar){
                                        echo $user_avatar;
                                    }

                                ?>
                                

                                <div class="user-name">
                                    <h5><?php echo $user->display_name; ?></h5>
                                    <p><?php echo $user->user_login; ?></p>

                                   
                                   
                                </div>
                            </div>
                            <hr>

                            <div class="role-action">
                                <h5>Current Role</h5>
                                <span> <?php 

                                    if(!empty($user->roles)){
                                        echo $user->roles[0];
                                    }else{
                                        echo 'No Role Assigned';
                                    }

                                ?> </span>
                            </div>

                            <div class="current-caps">
                                <h5>Current Capabilites</h5>
                                <div class="caps-container">

                                    <?php 

                                        if(!empty($user->allcaps)){

                                            if($user->roles[0] == 'administrator'){

                                                echo '<span> All Capabilities </span>';

                                            }else{

                                                foreach($user->allcaps as $cap_key => $cap_value){

                                                    echo '<span> '. $cap_key .'  </span>';
    
                                                }

                                            }


                                            

                                        }

                                    ?>
                                    
                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                        

                        
                    </div>

                    
                  

                </div>


            </div>



        <?php


    }





}