<?php
namespace Amin\AwesomeBookly\Interface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

interface Registerable {
	public function register_hook();
}
