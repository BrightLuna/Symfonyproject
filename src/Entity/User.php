<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: false)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?int $steamID = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profileurl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatarmedium = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatarfull = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getSteamID(): ?int
    {
        return $this->steamID;
    }

    public function setSteamID(int $steamID): self
    {
        $this->steamID = $steamID;

        return $this;
    }

    public function getProfileurl(): ?string
    {
        return $this->profileurl;
    }

    public function setProfileurl(?string $profileurl): self
    {
        $this->profileurl = $profileurl;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAvatarmedium(): ?string
    {
        return $this->avatarmedium;
    }

    public function setAvatarmedium(?string $avatarmedium): self
    {
        $this->avatarmedium = $avatarmedium;

        return $this;
    }

    public function getAvatarfull(): ?string
    {
        return $this->avatarfull;
    }

    public function setAvatarfull(?string $avatarfull): self
    {
        $this->avatarfull = $avatarfull;

        return $this;
    }

}
