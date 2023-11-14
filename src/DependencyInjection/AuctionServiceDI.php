<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\AuctionService;

trait AuctionServiceDI
{
    protected AuctionService $auctionService;

    /** @required
     * @param $auctionService
     */
    public function setAuctionService(AuctionService $auctionService): void
    {
        $this->auctionService = $auctionService;
    }
}
