<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:30
 */

namespace App\Entity;

use App\Repository\OrderRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
class Order
{
    const STATUS_PLACED    = "Placed";
    const STATUS_PAYED     = "Payed";
    const STATUS_COMPLETED = "Completed";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $deliveryAddress;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bids')]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Auction::class, inversedBy: 'bids')]
    private Auction $auction;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $status;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $price;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function __toString(): string
    {
        return $this->deliveryAddress ?: "";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(?string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getAuction(): Auction
    {
        return $this->auction;
    }

    public function setAuction(Auction $auction): void
    {
        $this->auction = $auction;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }
}
