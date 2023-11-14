<?php
/**
 * User: broasca
 * Date: 21.02.2023
 * Time: 23:45
 */

namespace App\Service;

class MetricsService
{
	function formatTime($t, $f = ':'): string // t = seconds, f = separator
	{
		return sprintf("%02d%s%02d%s%02d", floor($t / 3600), $f, ($t / 60) % 60, $f, $t % 60);
	}

	function formatSizeUnits($bytes): string
	{
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} else if ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} else if ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} else if ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} else if ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}

		return $bytes;
	}

	function processPeakMemUsage(): bool|int
	{
		$status = file_get_contents('/proc/' . getmypid() . '/status');
		$matches = [];
		preg_match_all('/^(VmPeak):\s*([0-9]+).*$/im', $status, $matches);
		return !isset($matches[2][0]) ? false : intval($matches[2][0]);
	}
}
