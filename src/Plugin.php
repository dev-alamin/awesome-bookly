<?php
namespace Amin\AwesomeBookly;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Amin\AwesomeBookly\CPT\PostMeta;
use Amin\AwesomeBookly\CPT\PostType;
use Amin\AwesomeBookly\CPT\Taxonomy;

final class Plugin {

	/**
	 * Plugin's main instance.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	public function __construct() {
		$this::boot();
	}

	/**
	 * Get singleton intance of the plugin.
	 *
	 * @return void
	 */
	public static function get_instance() {
		if ( null !== self::$instance ) {
			self::$instance == new self();
		}

		return self::$instance;
	}

	/**
	 * Boot the plugin.
	 *
	 * At this level load all the plugin's files, frontend or admin, rest.
	 *
	 * @return void
	 */
	public static function boot() {
		new Assets();

		$registrables = array( new PostType(), new PostMeta(), new Taxonomy() );

		foreach ( $registrables as $registrable ) {
			$registrable->register_hook();
		}

		// If purely admin, then run this.
		if ( is_admin() ) {

		}
	}

	/**
	 * Do things upon plugin activation.
	 *
	 * E.g creating DB tables, RBAC.
	 *
	 * @return void
	 */
	public function activation_hook() {
		// Will implement once we need.
	}
}
