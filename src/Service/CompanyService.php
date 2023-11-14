<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 10:54
 */

namespace App\Service;

use App\DependencyInjection\EntityManagerDI;
use App\Entity\Company;
use App\Entity\User;

class CompanyService
{
    use EntityManagerDI;

    public function create(
        string $name,
        string $email,
        string $contactNumber,
        string $creditCardInfo,
        User $user
    ): Company {
        $company = new Company();
        $company->setName($name);
        $company->setEmail($email);
        $company->setContactNumber($contactNumber);
        $company->setCreditCardInfo($creditCardInfo);
        $company->setUser($user);

        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $company;
    }
}
