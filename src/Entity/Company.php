<?php
/**
 * User: broasca
 * Date: 14.11.2023
 * Time: 10:45
 */

namespace App\Entity;


use App\Repository\CompanyRepository;
use Doctrine\DBAL\Types\Types;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $name;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $email;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $contactNumber;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $creditCardInfo;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'companies')]
    private User $user;

    public function __toString(): string
    {
        return $this->name ?? '';
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(?string $contactNumber): void
    {
        $this->contactNumber = $contactNumber;
    }

    public function getCreditCardInfo(): ?string
    {
        return $this->creditCardInfo;
    }

    public function setCreditCardInfo(?string $creditCardInfo): void
    {
        $this->creditCardInfo = $creditCardInfo;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
