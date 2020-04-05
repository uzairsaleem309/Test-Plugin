<?php
/**
 * Plugin Name: Test Plugin
 * Plugin URI: https://www.fiverr.com/uzair_saleem
 * Text Domain: test-plugin
 * Description: A wordpress plugin to show a table of users
 * Author: Uzair Saleem
 * Version: 1.0
 * Author URI: https://www.fiverr.com/uzair_saleem
 * @package WordPress
 * @author Uzair
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( !class_exists( 'TestPlugin' ) ) {
    class TestPlugin{
        private $config;
        public function __construct() {
            require_once "config.php";
            $this->config = $config;
            // check for required php version and deactivate the plugin if php version is less.
             if ( version_compare( PHP_VERSION, $this->config['required_php'], '<' ) ) {
                add_action( 'admin_notices', array( $this, 'test_plugin_show_notice' ), 100 );
                add_action( 'admin_init', array( $this, 'test_plugin_deactivate_self' ) );
                return;
            }
            add_action('wp_enqueue_scripts', array($this, 'test_plugin_enqueue_script'));
            add_action('init', array($this, 'test_plugin_custom_endpoint'));
            add_action( 'wp_ajax_nopriv_tp_get_data', array($this, 'test_plugin_get_data') );
            add_action( 'wp_ajax_tp_get_data', array($this, 'test_plugin_get_data') );
            
        }
        
        public function test_plugin_show_notice() {
            ?>
            <div class="error">
                <p><?php echo 'TestPlugin requires minimum PHP '.$this->config['required_php'].' to function properly. Please upgrade PHP version. The Plugin has been auto-deactivated.. You have PHP version '.PHP_VERSION; ?></p>
            </div>
            <?php
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }
        
        public function test_plugin_deactivate_self() {
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }
        
        public function test_plugin_custom_endpoint()
        {
            $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
            $templatename = $this->config['custom_endpoint'];
            $pos = strpos($url_path, $templatename);
            if ($pos !== false) {
            $load = include(dirname( __FILE__ ) . '/templates/'.$this->config['custom_endpoint'].'.php');
                if ($load) {
                    exit();
                }
                else
                {
                    include( get_query_template( '404' ) );
                }
            }
        }
        
        function test_plugin_enqueue_script() {  
            wp_enqueue_script( 'datatables-script', 'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js', array('jquery') );
            wp_enqueue_script('jquery-mobile-script', 'https://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js', array('jquery'));
            wp_enqueue_script('test-plugin-scripting', plugin_dir_url( __FILE__ ) . 'assets/js/test-project-script.js' , array('jquery'));
            wp_enqueue_style('datatables-style', 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css');
            wp_enqueue_style( 'jquery-mobile-style',  'https://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css');
            wp_enqueue_style( 'test-plugin-style',  plugin_dir_url( __FILE__ ) . 'assets/css/test-plugin-style.css');
            echo '<script type="text/javascript">
               var ajaxurl = "' . admin_url('admin-ajax.php') . '";
             </script>';
        }
        
        function test_plugin_get_data() {
            $request = "";
            if(!empty($_GET['userId']))
            {
                $request = wp_remote_get( $this->config['api_base_url'].'users/'.$_GET['userId'] );
            }
            else
            {
                $request = wp_remote_get( $this->config['api_base_url'].'users' );
            }

            if( is_wp_error( $request ) ) {
            	return "It seems like the API server didn't response correctly"; // Bail early
            }
            $data = "";
            $body = wp_remote_retrieve_body( $request );
            $data = json_decode($body);
            wp_send_json($data);
            wp_die();
        }
        
    }
}

if ( class_exists( 'TestPlugin' ) ) { // Instantiate the plugin class
    global $plgn;
    $plgn = new TestPlugin();
}