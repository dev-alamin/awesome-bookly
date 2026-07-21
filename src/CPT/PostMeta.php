<?php
namespace Amin\AwesomeBookly\CPT;

use Amin\AwesomeBookly\Interface\Registerable;
use Override;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PostMeta implements Registerable {
	private const META_PREFIX = 'awesome_bookly_';

	#[Override]
	public function register_hook() {
		add_action( 'init', array( $this, 'register_post_meta' ) );
	}

	private function get_default_args() {
		return array(
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => static fn() => current_user_can( 'edit_posts' ),
		);
	}

	public function register_post_meta() {
		$default_args = $this->get_default_args();

		// Decalre all the meta keys we need.
		$schema = array(
			self::META_PREFIX . 'isbn'           => array(
				'type' => 'string',
				...$default_args,
			),
			self::META_PREFIX . 'pub_date'       => array(
				'type' => 'string',
				...$default_args,
			),
			self::META_PREFIX . 'lang'           => array(
				'type' => 'string',
				...$default_args,
			),
			self::META_PREFIX . 'page_count'     => array(
				'type' => 'integer',
				...$default_args,
			),
			self::META_PREFIX . 'price'          => array(
				'type' => 'integer',
				...$default_args,
			),
			self::META_PREFIX . 'gallery_images' => array(
				'type'          => 'array',
				'single'        => true,
				'show_in_rest'  => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'integer',
						),
					),
				),
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			),
		);

		// Register each meta-key.
		foreach ( $schema as $meta_key => $args ) {
			register_post_meta( 'asm_bookly_book', $meta_key, $args );
		}
	}
}
