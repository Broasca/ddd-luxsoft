<?php
/**
 * User: broasca
 * Date: 03.05.2022
 * Time: 12:29
 */
namespace App\DependencyInjection;

use Symfony\Contracts\HttpClient\HttpClientInterface;

trait HttpClientInterfaceDI
{
	protected HttpClientInterface $client;

	/** @required */
	public function setHttpClientInterface(HttpClientInterface $client)
	{
		$this->client = $client;
	}
}
