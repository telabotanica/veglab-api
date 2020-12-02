<?php

namespace App\Security\SSO;

use App\Security\SSO\SSOTokenValidator;
use App\Security\SSO\MisconfiguredSSOTokenValidatorException;

/**
 * Authentication and user management using Tela Botanica's SSO
 * @todo : if annuaireURL null ou vide => return UnknownUser
 * @todo : param vide constructeur
 */
class SSOTokenDecoder {

	/** The validator for the JWT tokens as used by SSO Web services */
	protected $tokenValidator;

	public function __construct() {
        $this->tokenValidator = new SSOTokenValidator();
	}

	/**
	 * Returns the information array for an unknown user.
	 */
	private function getUnknownUser() {
		return array(
			'sub' => null,
			'id' => null, 
			'permissions' => array()
		);
	}

 	/**
	 * Searches for a JWT SSO token in the $this->headerName HTTP header, validates
	 * this token's authenticity against the "annuaire" SSO service and if
	 * successful, returns the decoded user information.
	 */
	public function getUserFromToken($token) {
		// unknown user, by default
		$user = $this->getUnknownUser();
		$valid = false;
		//echo "Token : $token\n";
		if ($token !== null) {
			// decode user's email address from token
			$tokenData = $this->decodeToken($token);
			if ($tokenData != null && $tokenData["sub"] != "") {
				$user = $tokenData;
			}
		}

		return $user;
	}

	/**
	 * Verifies the authenticity of a token using the "annuaire" SSO service
	 */
	private function verifyToken($token) {
		return $this->tokenValidator->validateToken($token);
	}

	/**
	 * Decodes a formerly validated JWT token and returns the data it contains
	 * (payload / claims)
	 */
	public function decodeToken($token) {
		$parts = explode('.', $token);
		$payload = $parts[1];
		$payload = $this->urlsafeB64Decode($payload);

		return json_decode($payload, true);
	}


	/**
	 * Method compatible with "urlsafe" base64 encoding used by JWT lib
	 */
	private function urlsafeB64Decode($input) {
		$remainder = strlen($input) % 4;
		if ($remainder) {
			$padlen = 4 - $remainder;
			$input .= str_repeat('=', $padlen);
		}

		return base64_decode(strtr($input, '-_', '+/'));
	}

}
