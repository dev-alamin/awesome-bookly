<?php
namespace Amin\AwesomeBookly;

class Assets {

	public function __construct() {
		add_action(
			'enqueue_block_editor_assets',
			array( $this, 'enqueue' )
		);
	}

	public function enqueue() {
		$asset_file = AWESOME_BOOKLY_PATH . 'assets/js/src/admin.asset.php';
		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = require $asset_file;

		wp_enqueue_script(
			'awesome-bookly-admin',
			AWESOME_BOOKLY_URL . '/assets/js/src/admin.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}
