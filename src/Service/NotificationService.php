<?php
/**
 * User: broasca
 * Date: 12.10.2022
 * Time: 10:36
 */

namespace App\Service;

use App\DependencyInjection\ContainerBagInterfaceDI;
use App\DependencyInjection\HttpClientInterfaceDI;
use App\DependencyInjection\MailerInterfaceDI;
use Symfony\Component\Mime\Email;

class NotificationService
{
	use ContainerBagInterfaceDI;
	use HttpClientInterfaceDI;
	use MailerInterfaceDI;

    public function sendEmail($email, $subject, $message)
	{
		$email = (new Email())
			->to($email)
			->subject($subject)
			->text($message);

//		/** @var Symfony\Component\Mailer\SentMessage $sentEmail */
		$sentEmail = $this->mailer->send($email);
	}
}
