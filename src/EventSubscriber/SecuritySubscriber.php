<?php
/**
 * User: broasca
 * Date: 13.10.2022
 * Time: 16:35
 */

namespace App\EventSubscriber;

use App\DependencyInjection\UserRepositoryDI;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class SecuritySubscriber implements EventSubscriberInterface
{
	use UserRepositoryDI;

	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::CONTROLLER => 'onKernelController',
			KernelEvents::EXCEPTION  => 'onKernelException',
			LoginSuccessEvent::class => 'onLoginSuccess',
		];
	}

	public function onLoginSuccess(LoginSuccessEvent $event)
	{
		/** @var User $user */
		$user = $event->getUser();
		$user->setLastLogin(new \DateTime());

		$ip = $event->getRequest()->getClientIp();
		$user->setLastIp($ip);

		$this->userRepository->persist($user);
		$this->userRepository->flush();
	}

	public function onKernelException(ExceptionEvent $event)
	{
		$exception = $event->getThrowable();
//		$response = new Response();
//		$response->setContent($exception->getMessage());
//		$event->setResponse($response);
	}

	public function onKernelController(ControllerEvent $event): void
	{
	}

}
