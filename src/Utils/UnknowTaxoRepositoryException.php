<?php

namespace App\Utils;

use \Exception;


class UnknowTaxoRepositoryException extends Exception {

	public function __construct() {
		parent::__construct("Invalid value for taxonomic repository name.", 0, null);
	}

}
