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
		throw new \Exception( 'Not implemented' );
	}
}
