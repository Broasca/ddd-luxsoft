<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\NotificationService;
use App\Service\SecurityService;

trait NotificationServiceDI
{
	protected NotificationService $notificationService;

	/** @required */
	public function setNotificationService(NotificationService $notificationService)
	{
		$this->notificationService = $notificationService;
	}
}
