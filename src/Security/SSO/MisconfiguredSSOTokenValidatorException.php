<?php

namespace App\Security\SSO;

use \Exception;


class MisconfiguredSSOTokenValidatorException extends Exception {

	public function __construct() {
		parent::__construct("Misconfigured SSOTokenValidator : no annuaire Web service URL provided to constructor.", 0, null);
	}

}
