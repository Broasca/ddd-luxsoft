<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\LoggerService;

trait LoggerServiceDI
{
	protected LoggerService $loggerService;

	/** @required */
	public function setLoggerService(LoggerService $loggerService)
	{
		$this->loggerService = $loggerService;
	}
}
