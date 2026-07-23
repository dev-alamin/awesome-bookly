<?php
namespace Amin\AwesomeBookly\CPT;

use Amin\AwesomeBookly\Interface\Registerable;
use Override;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Plugin's meta data.
 *
 * The Meta Data handler for the app.
 * Very easy to add new meta key.
 *
 * @since 1.0.0
 * @package AsmBookly
 */
class PostMeta implements Registerable {
	/**
	 * Post meta constant prefix.
	 */
	private const META_PREFIX = 'awesome_bookly_';

	#[Override]
	public function register_hook() {
		add_action( 'init', array( $this, 'register_post_meta' ) );
	}

	/**
	 * Default args that we need to repeat.
	 *
	 * @return array
	 */
	private function get_default_args(): array {
		return array(
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => static fn() => current_user_can( 'edit_posts' ),
		);
	}

	/**
	 * Register and add new meta data.
	 *
	 * @return void
	 */
	public function register_post_meta() {
		$default_args = $this->get_default_args();

		// Decalre all the meta keys we need.
		$schema = array(
			self::META_PREFIX . 'isbn'           => array(
				...$default_args,
				'type' => 'string',
			),
			self::META_PREFIX . 'pub_date'       => array(
				...$default_args,
				'type' => 'string',
			),
			self::META_PREFIX . 'lang'           => array(
				...$default_args,
				'type' => 'string',
			),
			self::META_PREFIX . 'page_count'     => array(
				...$default_args,
				'sanitize_callback' => 'absint',
			),
			self::META_PREFIX . 'price'          => array(
				...$default_args
			),
			self::META_PREFIX . 'gallery_images' => array(
				...$default_args,
				'type'              => 'array',
				'show_in_rest'      => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'integer',
						),
					),
				),
				'sanitize_callback' => static function ( $val ) {
					return array_map( 'absint', (array) $val );
				},
			),
		);

		// Register each meta-key.
		foreach ( $schema as $meta_key => $args ) {
			register_post_meta( 'asm_bookly_book', $meta_key, $args );
		}
	}
}
