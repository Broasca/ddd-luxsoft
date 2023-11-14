<?php
/**
 * User: broasca
 * Date: 31.07.2021
 * Time: 23:49
 */

namespace App\DependencyInjection;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

trait EntityManagerDI
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @required
     * @param EntityManagerInterface $entityManager
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
