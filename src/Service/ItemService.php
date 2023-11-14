<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:38
 */

namespace App\Service;

use App\DependencyInjection\EntityManagerDI;

class ItemService
{

    use EntityManagerDI;

    public function create(
        string $name,
        string $description,
        string $category,
        int $initialPrice
    ) {
        $item = new Item();
        $item->setName($name);
        $item->setDescription($description);
        $item->setCategory($category);
        $item->setInitialPrice($initialPrice);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $item;
    }
}
