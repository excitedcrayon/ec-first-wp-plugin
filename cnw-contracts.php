<?php
/**
* Plugin Name: CNW Contracts
* Plugin URI: http://intranet.bgwgroup.com.au
* Description: Insert and display CNW contracts in a sort and search table. Make sure to export data to a CSV file before                  deactivating the plugin. Failure to do so will result in loss of all your data which cannot be recovered.
* Version: 1.0
* Author: Bongani Mkonto
* Author URI: https://github.com/excitedcrayon
*/

include_once('config.php');
include_once(PLUGIN_DIR.'/inc/Functions.php');

// export to CSV method
Functions::export_to_csv();
// import CSV method
Functions::import_csv_to_db();

// create db table on plugin activation
register_activation_hook(__FILE__, 'Functions::create_db_table');

// drop db table on plugin de-activation | delete
register_deactivation_hook(__FILE__, 'Functions::drop_db_table');

// create admin menu when plugin is activated
add_action( 'admin_menu', 'Functions::init_menu');

// load styles, js and image assets
add_action( 'init', 'Functions::load_assets' );


function insert_contract( $attributes ){
    //display_things();
    $parameters = array(
        'user_role' => 'user_role',
        'user_access' => 'user_access'
    );

    extract( shortcode_atts( $parameters, $attributes ) );

    $user_role = preg_match('/'.Functions::check_user_role().'/i', $attributes['user_role']);
    $user_access = preg_match('/'.Functions::check_username().'/i', $attributes['user_access']);

    if( !(is_user_logged_in()) ){
        Functions::display_error_message('Access denied. You do not have permission to view this page');
    }else if( ($user_role && $user_access) || $user_role || $user_access) {
        Functions::view_contracts_table();
    }else{
        Functions::display_error_message('Access denied. You do not have permission to view this page');
    }
}
add_shortcode( 'insert_contract', 'insert_contract' );
?>
