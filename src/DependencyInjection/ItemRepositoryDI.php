<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Repository\ItemRepository;

trait ItemRepositoryDI
{
    protected ItemRepository $itemRepository;

    /** @required */
    public function setItemRepository(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }
}
