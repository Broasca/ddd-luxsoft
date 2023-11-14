<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Composer\Autoload\ClassLoader;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    const TYPE_SELLER = 'Seller';
    const TYPE_BUYER  = 'Buyer';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true, nullable: true)]
    private ?string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $fullName;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $type;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $password;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $lastLogin;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $lastIp;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?array $roles;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Company::class)]
    private $companies;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $shippingAddress;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $billingAddress;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $creditCardInfo;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Item::class)]
    private $items;

    #[ORM\OneToMany(mappedBy: 'auctions', targetEntity: Auction::class)]
    private $auctions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Bid::class)]
    private $bids;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->auctions = new ArrayCollection();
        $this->bids = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->email ?: '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
//        $roles = $this->roles;
        $roles[] = 'ROLE_ADMIN';
        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getLastLogin(): ?DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?DateTime $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getLastIp(): ?string
    {
        return $this->lastIp;
    }

    public function setLastIp(?string $lastIp): void
    {
        $this->lastIp = $lastIp;
    }

    public function getCompanies()
    {
        return $this->companies;
    }

    public function setCompanies($companies): void
    {
        $this->companies = $companies;
    }

    public function getShippingAddress(): ?string
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?string $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }

    public function getBillingAddress(): ?string
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?string $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    public function getCreditCardInfo(): ?string
    {
        return $this->creditCardInfo;
    }

    public function setCreditCardInfo(?string $creditCardInfo): void
    {
        $this->creditCardInfo = $creditCardInfo;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function getAuctions(): ArrayCollection
    {
        return $this->auctions;
    }

    public function setAuctions(ArrayCollection $auctions): void
    {
        $this->auctions = $auctions;
    }

    public function getBids(): ArrayCollection
    {
        return $this->bids;
    }

    public function setBids(ArrayCollection $bids): void
    {
        $this->bids = $bids;
    }
}
