<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Repository\OrderRepository;

trait OrderRepositoryDI
{
    protected OrderRepository $orderRepository;

    /** @required */
    public function setOrderRepository(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
}
