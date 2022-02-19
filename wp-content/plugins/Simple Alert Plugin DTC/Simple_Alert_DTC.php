<?php
/*
* Plugin Name: Simple Alert DTC
* Description: Simple Alert Plugin for DTC Task a
* Version: 0.2
* Author: Omar Atef
*/


require_once( 'lib/notification/load.php' );
// require_once( 'customTrigger.php' );
// use BracketSpace\Notification\Register;

// function theme_enqueue_scripts() {
//     /**
//      * frontend ajax requests.
//      */
//     // wp_enqueue_script( 'frontend-ajax', JS_DIR_URI . 'frontend-ajax.js', array('jquery'), null, true );
//     wp_localize_script( 'onSelect', 'onSelect',
//         array( 
//             'ajaxurl' => admin_url( 'onSelect.php' ),
//             'data_var_1' => 'value 1',
//             'data_var_2' => 'value 2',
//         )
//     );
// }
// add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

wp_enqueue_script( 'my-ajax-request', plugins_url( '/myajax.js', __FILE__ ), array( 'jquery' ) );
wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'onSelect.php' ) ) );

// function theFunctionThatMyAjaxWillCall() {
//   // include your ajax file here, in this case
//   // I assumed that we placed the gethint.php in 
//   // /wp-content/plugins/yourpluginname/gethint.php
//   include( plugin_dir_path( __FILE__ ).'onSelect.php' );

//   // don't forget to add "die;" every time you return a response to your ajax
//   //Example: echo $hint ?? "no suggestion"; die;

//   // or you can add the termination code right here
//   die; // this will prevent the ajax response to have 0 in the end.

// }
// add_action( 'wp_ajax_theNameOfMyCustomAjax', 'theFunctionThatMyAjaxWillCall' );



// Our custom post type function
function create_posttype() {
 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function admin_Alert_Menu() {
    add_menu_page(
        __( 'Alert Page', 'my-textdomain' ),
        __( 'Alert Menu', 'my-textdomain' ),
        'manage_options',
        'Alert-Menu-Page',
        'admin_Alert_Menu_Contents',
        'dashicons-schedule',
        3
    );
}
add_action( 'admin_menu', 'admin_Alert_Menu' );

function admin_Alert_Menu_Contents() {
    ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <style type="text/css">
            form {
                overflow: hidden;
            }
            input {
                float: right;
                clear: both;
            }
        </style>
        <!-- <script>
            
        </script> -->
        <h1>
            <!-- <?php esc_html_e( 'Welcome to my custom admin page.', 'my-plugin-textdomain' ); ?> -->
            Welcome to my 
        </h1>
        <form action="/action_page.php">
            <div>
                <label for="AlertMsg">Alert Message:</label>
                <input type="text" id="AlertMsg" name="AlertMsg"><br><br>
                <input type="submit" value="Submit">
            </div>
            <div>
                <select name="postTypes" id="post_types" onchange='update(this.value)'>
                    <option value="">--- Choose Post Type ---</option>
                    <?php
                        $args = array(
                            // 'post_type' => 'custom',
                            // 'posts_per_page' => -1
                        );
                         
                        $post_types = get_post_types( $args, 'objects' ); 

                        foreach ( $post_types  as $post_type ) {
                            $name = $post_type->name;
                            //    echo '<p>Custom Post Type name: ' . $post_type->name . "<br />\n";
                            //    echo 'Single name: ' . $post_type->labels->singular_name . "<br />\n";
                            //    echo 'Menu icon URL: ' . $post_type->menu_icon . "</p>\n";
                            echo '<option value="'.$name.'">'.$name.'</option>';
                        }
                    ?>
                    <!-- <option value="red">Red</option>
                    <option value="green" selected>Green</option>
                    <option value="blue">Blue</option> -->
                 </select>
            </div>
            <div id="checkBoxes">
            </div>
        </form> 
        <?php

        // $scriptCode = "
        // $('select').on('change', function (e) {
        //     var optionSelected = $('option:selected', this);
        //     var valueSelected = this.value;
        //     alert(this.value);
        // });";

        // echo "<script>".$scriptCode."</script>";

        $queryArgs = array(
            'post_type'=> "Movies"
        );  
        $the_query = new WP_Query( $queryArgs );

        ?>
    <?php
}

// add_action( 'notification/init', function() {
// 	notification_whitelabel([
//         // admin page hook under which you want the Notifications to be displayed.
//         'post_type'       => 'movies',
//         // if display extensions.
//         'extensions'      => false,
//         // if display settings.
//         'settings'        => false,
//         // control settings access, provided user IDs will have an access.
//         // this works only if settings are enabled.
//         'settings_access' => array( 123, 456 ),
//     ] );
// } );

// add_action( 'notification/init', function() {
//     Register::trigger( new CustomTrigger('Movies') );
// } );


// notification_whitelabel( );

// function load_custom_wp_admin_style($hook) {
// 	// Load only on ?page=mypluginname
// 	if( $hook != 'toplevel_page_mypluginname' ) {
// 		 return;
// 	}
// 	wp_enqueue_style( 'custom_wp_admin_css', 
// plugins_url('admin-style.css', __FILE__) );
// }
// add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

// function load_custom_wp_admin_style( $hook ) {
// 	// Load only on ?page=mypluginname
// 	if( $hook != 'toplevel_page_Alert-Menu-Page' ) {
// 		 return;
// 	}
// 	// Load color picker styles. 
// 	wp_enqueue_style( 'wp-color-picker' );
// }
// add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );




