<?php
/**
 * User: broasca
 * Date: 02.10.2022
 * Time: 13:46
 */

namespace App\Service;

use App\DependencyInjection\ContainerBagInterfaceDI;
use App\DependencyInjection\NotificationServiceDI;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Monolog\Handler\FirePHPHandler;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoggerService
{
	use NotificationServiceDI;
	use ContainerBagInterfaceDI;

	public function initializeLogger($logName, string $path = null): Logger
	{
		$logger = new Logger($logName);
		$logPath = $this->containerBag->get('base_path') . "/var/log/" . $path . ".log";
		$logger->pushHandler(new StreamHandler($logPath, Level::Debug));
		$logger->pushHandler(new FirePHPHandler());
		$logger->info("Initialize..", ["command" => $logName]);
		return $logger;
	}

	public function writeSuccess(LoggerInterface $log, SymfonyStyle $io, $message, ?bool $sendNotification = false): void
	{
		$io->success($message);
		$log->info($message);
	}

	public function writeInfo(LoggerInterface $log, SymfonyStyle $io, $message): void
	{
		$io->text($message);
		$log->info($message);
	}

	public function writeException($scope, LoggerInterface $log, SymfonyStyle $io, \Exception $exception, $description): string
	{
		$io->error($exception->getMessage());
		$log->error($exception->getMessage(), ['trace' => $exception->getTrace()]);

		return "| Error " . $exception->getMessage();
	}
}
