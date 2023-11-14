<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\MetricsService;

trait MetricsServiceDI
{
	protected MetricsService $metricsService;

	/** @required */
	public function setMetricsService(MetricsService $metricsService)
	{
		$this->metricsService = $metricsService;
	}
}
