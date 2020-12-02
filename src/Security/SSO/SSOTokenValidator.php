<?php

namespace App\Security\SSO;

use App\Security\SSO\MisconfiguredSSOTokenValidatorException;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Authentication and user management using Tela Botanica's SSO
 *
 * @todo : param vide constructeur
 */
class SSOTokenValidator {

	/** The URL for the "annuaire" SSO Web Service */
	protected $annuaireURL;
	/** The URL for the "annuaire" SSO Web Service */
	protected $ignoreSSLIssues = false;

	public function __construct() {
	    $this->annuaireURL = getenv('SSO_ANNUAIRE_URL');
	    $this->ignoreSSLIssues = getenv('IGNORE_SSL_ISSUES');
	}

	private function generateAuthCheckURL($token) {
		$verificationServiceURL = $this->annuaireURL;
		$verificationServiceURL = trim($verificationServiceURL, '/') . "/verifytoken";
		$verificationServiceURL .= "?token=" . $token;

        return $verificationServiceURL;
	}

	/**
	 * Verifies the authenticity of a token using the "annuaire" SSO service
	 */
	public function validateToken($token) {
		if ( empty($this->annuaireURL) ) {
			throw new MisconfiguredSSOTokenValidatorException();
		}
		$verificationServiceURL = $this->generateAuthCheckURL($token);
		$verificationServiceURL = str_replace('Bearer ', '', $verificationServiceURL); // On my local dev (using 'annuaire' Docker image), $token contains 'Bearer ' + token key
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $verificationServiceURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		// equivalent of "-k", ignores SSL self-signed certificate issues
		// (for local testing only)
		if (! empty($this->ignoreSSLIssues) && $this->ignoreSSLIssues === true) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}

		$data = curl_exec($ch);

        if ( curl_errno($ch) ) {
            throw new \Exception ('curl erreur: ' . curl_errno($ch));
        }
		curl_close($ch);
		$info = $data;

		$info = json_decode($info, true);
		return ($info === true);
	}

}
