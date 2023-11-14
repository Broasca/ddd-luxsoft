<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:30
 */

namespace App\Entity;

use App\Repository\AuctionRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuctionRepository::class)]
class Auction
{
    const STATUS_ACTIVE   = "Active";
    const STATUS_INACTIVE = "Inactive";
    const STATUS_LOCKED   = "Locked";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $name;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $description;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'auctions')]
    private Item $item;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'auctions')]
    private User $owner;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $status;

    #[ORM\OneToMany(mappedBy: 'auction', targetEntity: Bid::class)]
    private $bids;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTime $endDate;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->bids = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?: "";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    public function getInitialPrice(): ?int
    {
        return $this->initialPrice;
    }

    public function setInitialPrice(?int $initialPrice): void
    {
        $this->initialPrice = $initialPrice;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setItem(Item $item): void
    {
        $this->item = $item;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getBids()
    {
        return $this->bids;
    }

    public function setBids($bids): void
    {
        $this->bids = $bids;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
}
