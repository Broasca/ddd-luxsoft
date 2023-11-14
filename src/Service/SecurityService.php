<?php
/**
 * User: broasca
 * Date: 20.04.2023
 * Time: 23:59
 */

namespace App\Service;

use App\DependencyInjection\ContainerBagInterfaceDI;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SecurityService
{
	use ContainerBagInterfaceDI;

	/**
	 * Encrypt a string using OpenSSL
	 *
	 * @param string $string The string to encrypt
	 * @return string The encrypted string
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	function encryptString(string $string): string
	{
		$key = $this->containerBag->get('encrypt_key');
		$method = $this->containerBag->get('encrypt_ciphering');
		$ivLen = openssl_cipher_iv_length($method);
		$iv = openssl_random_pseudo_bytes($ivLen);
		$ciphertext = openssl_encrypt($string, $method, $key, OPENSSL_RAW_DATA, $iv);
		$encrypted = base64_encode($iv . $ciphertext);
		return $encrypted;
	}

	/**
	 * Decrypt a string using OpenSSL
	 *
	 * @param string $encrypted The encrypted string
	 * @return string|false The decrypted string, or false on error
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 * @throws Exception
	 */
	function decryptString(?string $encrypted): bool|string
	{
		if (!$encrypted) {
			throw new Exception("Missing encrypt parameter");
		}
		$key = $this->containerBag->get('encrypt_key');
		$method = $this->containerBag->get('encrypt_ciphering');
		$decoded = base64_decode($encrypted);
		$ivLen = openssl_cipher_iv_length($method);
		$iv = substr($decoded, 0, $ivLen);
		$ciphertext = substr($decoded, $ivLen);
		$decrypted = openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
		return $decrypted !== false ? $decrypted : false;
	}
}
