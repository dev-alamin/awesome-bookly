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
		$issbn_args = array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callabck'     => function () {
				return current_user_can( 'edit_posts' );
			},
		);

		register_post_meta( 'asm_bookly_book', self::META_PREIFX . 'isbn', $issbn_args );
	}
}
