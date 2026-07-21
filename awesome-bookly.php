<?php
/**
 * Plugin Name: Awesome Bookly
 * Description: A plugin to help organizing books, using gutenberg as well.
 * Version: 0.1.0
 * Author: Al Amin
 * Author URI: https://github.com/dev-alamin
 * Plugin URI: https://github.com/dev-alamin/awesome-bookly
 *
 * @package AsmBookly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

new Amin\AwesomeBookly\Plugin();
