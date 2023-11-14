<?php
/**
 * User: broasca
 * Date: 05.06.2023
 * Time: 17:10
 */

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mime\Email;

class SetFromListener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return [
			MessageEvent::class => 'onMessage',
		];
	}

	public function onMessage(MessageEvent $event)
	{
		$email = $event->getMessage();
		if (!$email instanceof Email) {
			return;
		}
		$email->from('admin@calisto.app');
	}
}

