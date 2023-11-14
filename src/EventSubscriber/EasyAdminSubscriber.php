<?php
/**
 * User: broasca
 * Date: 13.10.2022
 * Time: 12:24
 */

namespace App\EventSubscriber;

use App\DependencyInjection\AdminUrlGeneratorDI;
use App\DependencyInjection\ContainerBagInterfaceDI;
use App\DependencyInjection\MetricsServiceDI;
use App\DependencyInjection\RequestStackDI;
use App\DependencyInjection\SecurityServiceDI;
use App\DependencyInjection\UserPasswordHasherInterfaceDI;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	use AdminUrlGeneratorDI;
	use RequestStackDI;
	use MetricsServiceDI;
	use ContainerBagInterfaceDI;
	use UserPasswordHasherInterfaceDI;
	use SecurityServiceDI;

	public static function getSubscribedEvents()
	{
		return [
			BeforeEntityPersistedEvent::class => ['beforeEntityPersistedEvent'],
			AfterEntityPersistedEvent::class  => ['afterEntityPersistedEvent'],
			BeforeEntityUpdatedEvent::class   => ['beforeEntityUpdatedEvent'],
			AfterEntityUpdatedEvent::class    => ['afterEntityUpdatedEvent'],
			BeforeEntityDeletedEvent::class   => ['beforeEntityDeletedEvent'],
			AfterEntityDeletedEvent::class    => ['afterEntityDeletedEvent'],
		];
	}

	public function beforeEntityPersistedEvent(BeforeEntityPersistedEvent $event)
	{
		$entity = $event->getEntityInstance();
		return;
	}

	public function afterEntityPersistedEvent(AfterEntityPersistedEvent $event)
	{
		$entity = $event->getEntityInstance();

		return;
	}

	public function beforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event)
	{
		$entity = $event->getEntityInstance();
//		if ($entity instanceof User) {
//			$pass = $entity->getPlainPassword();
//			$hashedPassword = $this->userPasswordHasher->hashPassword(
//				$entity,
//				$pass
//			);
//			$entity->setPassword($hashedPassword);
//			$entity->setPlainPassword(null);
//		}

	}

	public function afterEntityUpdatedEvent(AfterEntityUpdatedEvent $event)
	{

	}

	public function beforeEntityDeletedEvent(BeforeEntityDeletedEvent $event)
	{
		$entity = $event->getEntityInstance();
	}

	public function afterEntityDeletedEvent(AfterEntityDeletedEvent $event)
	{
		$entity = $event->getEntityInstance();

	}

}
