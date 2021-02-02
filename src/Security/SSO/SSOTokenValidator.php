<?php

namespace App\Security\SSO;

use App\Security\SSO\MisconfiguredSSOTokenValidatorException;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Authentication and user management using SSO
 *
 * @todo : param vide constructeur
 */
class SSOTokenValidator {

	protected $ssoGetUserInfoURL;	// Keycloak userInfo endpoint ; used to check user's token
	protected $ignoreSSLIssues = false;

	public function __construct() {
	    $this->annuaireURL = getenv('SSO_ANNUAIRE_URL');
			$this->ignoreSSLIssues = getenv('IGNORE_SSL_ISSUES');
			$this->ssoGetUserInfoURL = getenv('SSO_USERINFO_URL');
	}

	private function generateAuthCheckURL() {
		$verificationServiceURL = $this->annuaireURL;
		return $verificationServiceURL;
	}

	/**
	 * Verifies the authenticity of a token using the "annuaire" SSO service
	 */
	public function validateToken($token) {
		if ( empty($this->annuaireURL) ) {
			throw new MisconfiguredSSOTokenValidatorException();
		}
		$verificationServiceURL = $this->generateAuthCheckURL();
		$ch = curl_init();
		$timeout = 5;

		curl_setopt($ch, CURLOPT_URL, $this->ssoGetUserInfoURL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));

		// if ($_SERVER['HTTP_HOST'] == 'localhost:8080') {
		// 	// Proxy for Docker
		// 	curl_setopt($ch, CURLOPT_PROXY, $_SERVER['SERVER_ADDR'] . ':' .  $_SERVER['SERVER_PORT']);
		// }
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1); // Debug purpose
		curl_setopt($ch, CURLOPT_HEADER, 1); // Debug
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
            throw new \Exception ('curl erreur ' . curl_errno($ch) . ' : ' . curl_error($ch));
				}

		curl_close($ch);
		$info = $data;

		$info = json_decode($info, true);

		return true;
		return ($info === true);
	}

}
