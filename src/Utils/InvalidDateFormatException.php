<?php

namespace App\Utils;

use \Exception;


class InvalidDateFormatException extends Exception {

	public function __construct() {
		parent::__construct("Invalid date format.", 0, null);
	}

}
