<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:38
 */

namespace App\Service;

use App\DependencyInjection\EntityManagerDI;
use App\DependencyInjection\UserPasswordHasherInterfaceDI;
use App\Entity\User;

class UserService
{
    use EntityManagerDI;
    use UserPasswordHasherInterfaceDI;

    public function register(string $email, string $plainPassword): User
    {
        $user = $this->entityManager->getRepository(User::class)->findOneByEmail($email);
        if ($user) {
            throw new \Exception("User already exists");
        }
        $user = new User();
        $user->setEmail($email);

        $hashedPassword = $this->userPasswordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
