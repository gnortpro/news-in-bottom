<?php

/*
Plugin Name: News In Bottom
Plugin URI: https://trongggg.com/
Description: Code for fun !
Version: 1.0
Author: Trọng Đẹp Zai
Author URI: https://trongggg.com/
License: GPLv2 or later
Text Domain: news-in-bottom
*/
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
if(!class_exists('NewsInBottom')) {
    class NewsInBottom {
        function __construct() {
            // add_action('wp_head',  array( &$this, 'create_header' )); 
            add_action('wp_footer',  array( &$this, 'create_html' )); 
        }

        function create_html() {
                $text = get_option( 'news_in_bottom_option', '' );
                if ( $text != '' ) {
                    // echo $text;
                    echo "<script> alert(21321321)</script>";
            }
        }
        // function create_header() {
        //     echo "<script> alert('header')</script>";
        // }

    }
}

function enqueue_scripts_and_styles()
{
        wp_register_style( 'css', get_template_directory_uri() . '/css/styles.css', array() );
        wp_enqueue_style( 'css' );
        wp_enqueue_script('jquery');
        wp_register_script('my-plugin-script', plugins_url( '/js/script.js', __FILE__ ));
        wp_enqueue_script( 'my-plugin-script' );
 
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );

function mfpd_load() {
    global $mfpd;
    $mfpd = new NewsInBottom();
    

}
add_action( 'plugins_loaded', 'mfpd_load' );

function register_mysettings() {
    register_setting( 'mfpd-settings-group', 'news_in_bottom_option' );
}
 
function mfpd_create_menu() {
        add_menu_page('News In Bottom Settings', 'News In Bottom', 'administrator', __FILE__, 'mfpd_settings_page','dashicons-chart-pie', 1);
        add_action( 'admin_init', 'register_mysettings' );
}
add_action('admin_menu', 'mfpd_create_menu'); 
 
function mfpd_settings_page() {
?>
<div class="wrap">
<h2>Plugin setting page</h2>
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>

<?php } ?>
<form method="post" action="options.php">
    <?php settings_fields( 'mfpd-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Number posts display: </th>
        <td><input type="number" name="news_in_bottom_option" value="<?php echo get_option('news_in_bottom_option'); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>

<?php  }

 
function createNewCategory() {
    wp_insert_term(
        'News In Bottom Category', 
        'category', 
        array(
        'slug' => 'news-in-bottom-category',  
    ));
}

// function create_html() { 
//     echo '<div style="background: green; color: white; text-align: right;">WPShout was here.</div>'; 
// }


// function when_activate_plugin() { 
//     add_action('wp_footer', 'create_html', 10); 
// }

// function when_deactive_plugin() { 

// }

// function when_activate_plugin() {
//     global $wpdb;
//     createNewCategory();
//     print_r($wpdb);
//     $table_name = $wpdb->prefix . 'news_in_bottom_setting';
//     $sql = 'CREATE TABLE '.$table_name.'(
//     id INTEGER NOT NULL,
//     number_posts INTEGER(3),
//     PRIMARY KEY (id))';

//     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//     dbDelta( $sql );
// }   

// function remove_database() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'news_in_bottom_setting';
//     $sql = "DROP TABLE IF EXISTS $table_name";
//     $wpdb->query($sql);
// } 

// register_activation_hook(__FILE__, 'when_activate_plugin');
// register_deactivation_hook( __FILE__, 'when_deactive_plugin');