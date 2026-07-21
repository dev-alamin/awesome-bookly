<?php
namespace Amin\AwesomeBookly\CPT;

use Amin\AwesomeBookly\Interface\Registerable;
use Override;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Taxonomy implements Registerable {

	#[Override]
	public function register_hook() {
		add_action( 'init', array( $this, 'register_taxonomy_cb' ) );
	}

	public function register_taxonomy_cb() {
		$args = array(
			'labels'       => array(
				'name'          => __( 'Authors', 'awesome-bookly' ),
				'singular_name' => __( 'Author', 'awesome-bookly' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'hierarchical' => true,

		);

		register_taxonomy( 'book_author', 'asm_bookly_book', $args );
	}
}
