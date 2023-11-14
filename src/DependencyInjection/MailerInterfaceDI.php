<?php
/**
 * User: broasca
 * Date: 31.07.2021
 * Time: 23:49
 */

namespace App\DependencyInjection;

use Symfony\Component\Mailer\MailerInterface;

trait MailerInterfaceDI
{
	protected MailerInterface $mailer;

	/**
	 * @required
	 */
	public function setMailerInterface(MailerInterface $mailer)
	{
		$this->mailer = $mailer;
	}
}
