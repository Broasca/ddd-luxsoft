<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 12:00
 */

namespace App\Service;

use App\Entity\Auction;
use App\Entity\Bid;

class AuctionService
{
    public function caculcateHighestBid(Auction $auction)
    {
        $highestBid = 0;
        $bids = $auction->getBids();
        /** @var Bid $bid */
        foreach ($bids as $bid) {
            if ($bid->getAmount() > $highestBid) {
                $highestBid = $bid->getAmount();
            }
        }

        return $highestBid;
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
