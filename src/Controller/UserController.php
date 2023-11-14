<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:09
 */

namespace App\Controller;

use App\DependencyInjection\AuctionRepositoryDI;
use App\DependencyInjection\AuctionServiceDI;
use App\DependencyInjection\ItemRepositoryDI;
use App\DependencyInjection\OrderRepositoryDI;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    use ItemRepositoryDI;
    use AuctionRepositoryDI;
    use OrderRepositoryDI;
    use AuctionServiceDI;

    #[Route('/user/profile', name: 'user_profile')]
    public function userProfile(): Response
    {
        return $this->render("user/profile.html.twig");
    }

    #[Route('/user/collection', name: 'user_collection')]
    public function userCollection(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $items = $this->itemRepository->findBy([
            'user' => $user,
        ]);
        $ret['items'] = $items;
        return $this->render("user/collection.html.twig", $ret);
    }

    #[Route('/user/auctions', name: 'user_auctions')]
    public function userAuctions(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $auctions = $this->auctionRepository->findAll();
        $ret['auctions'] = $auctions;
        return $this->render("user/auctions.html.twig", $ret);
    }

    #[Route('/user/auction/{auctionId}', name: 'user_auction_details')]
    public function userAuctionDetails($auctionId): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $auction = $this->auctionRepository->find($auctionId);
        if (!$auction) {
            $this->addFlash('warning', 'Auction not found');
            return $this->redirectToRoute('user_auctions');
        }
        $ret['auction'] = $auction;
        $currentBid = $this->auctionService->caculcateHighestBid($auction);
        $ret['currentBid'] = $currentBid;

        return $this->render("user/auction_details.html.twig", $ret);
    }

    #[Route(' / user / orders', name: 'user_orders')]
    public function userOrders(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $orders = $this->orderRepository->findAll();
        $ret['orders'] = $orders;
        return $this->render("user/orders.html.twig", $ret);
    }
}
