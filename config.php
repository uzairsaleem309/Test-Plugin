<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * The base configuration for TestPlugin
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @package WordPress
 */
$config = array(
    "required_php" => 7.1,
    "custom_endpoint" => "test_page",
    "api_base_url" => "https://jsonplaceholder.typicode.com/",
);
?>