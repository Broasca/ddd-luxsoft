<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Repository\AuctionRepository;
use App\Repository\ItemRepository;

trait AuctionRepositoryDI
{
    protected AuctionRepository $auctionRepository;

    /** @required */
    public function setAuctionRepository(AuctionRepository $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }
}
