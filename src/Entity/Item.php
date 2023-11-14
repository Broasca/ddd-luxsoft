<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 11:30
 */

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
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

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $category;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $initialPrice;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'items')]
    private User $user;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: Auction::class)]
    private $auctions;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $status;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->auctions = new ArrayCollection();
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getAuctions()
    {
        return $this->auctions;
    }

    public function setAuctions($auctions): void
    {
        $this->auctions = $auctions;
    }
}
