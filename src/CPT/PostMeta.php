<?php
namespace Amin\AwesomeBookly\CPT;

use Amin\AwesomeBookly\Interface\Registerable;
use Override;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PostMeta implements Registerable {
	private const META_PREIFX = 'awesome_bookly_';

	#[Override]
	public function register_hook() {
		add_action( 'init', array( $this, 'register_post_meta' ) );
	}

	public function register_post_meta() {
		// Decalre all the meta keys we need.
		$schema = array(
			self::META_PREIFX . 'isbn'           => array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callabck'     => function () {
					return current_user_can( 'edit_posts' );
				},
			),
			self::META_PREIFX . 'pub_date'       => array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callabck'     => function () {
					return current_user_can( 'edit_posts' );
				},
			),
			self::META_PREIFX . 'lang'           => array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callabck'     => function () {
					return current_user_can( 'edit_posts' );
				},
			),
			self::META_PREIFX . 'page_count'     => array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callabck'     => function () {
					return current_user_can( 'edit_posts' );
				},
			),
			self::META_PREIFX . 'price'          => array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callabck'     => function () {
					return current_user_can( 'edit_posts' );
				},
			),
			self::META_PREIFX . 'gallery_images' => array(
				'type'          => 'array',
				'single'        => true,
				'show_in_rest'  => array(
					'schema' => array(
						'type'  => '',
						'items' => array(
							'type' => 'integer',
						),
					),
				),
				'auth_callabck' => function () {
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
