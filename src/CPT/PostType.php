<?php
namespace Amin\AwesomeBookly\CPT;

use Amin\AwesomeBookly\Interface\Registerable;
use Override;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PostType implements Registerable {

	#[Override]
	public function register_hook() {
		add_action( 'init', array( $this, 'register_book_cpt' ) );
	}

	public function register_book_cpt() {
		$label = array(
			'name'          => __( 'Books', 'awesome-bookly' ),
			'singular_name' => __( 'Book', 'awesome-bookly' ),
		);

		register_post_type(
			'asm_bookly_book',
			array(
				'labels'       => $label,
				'show_in_rest' => true,
				'public'       => true,
				'show_in_menu' => true,
				'rewrite'      => array(
					'slug' => 'books',
				),
				'supports'     => array( 'title', 'thumbnail', 'editor' ),
			)
		);
	}
}
