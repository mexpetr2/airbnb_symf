<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'addBy', targetEntity: Appartment::class)]
    private Collection $appartments;

    public function __construct()
    {
        $this->appartments = new ArrayCollection();
    }

    // #[ORM\OneToMany(mappedBy: 'addBy',  targetEntity: Appartment::class)]
    // private ?Appartment $appartment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    // public function getAppartment(): ?Appartment
    // {
    //     return $this->appartment;
    // }

    // public function setAppartment(Appartment $appartment): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($appartment->getAddBy() !== $this) {
    //         $appartment->setAddBy($this);
    //     }

    //     $this->appartment = $appartment;

    //     return $this;
    // }

    /**
     * @return Collection<int, Appartment>
     */
    public function getAppartments(): Collection
    {
        return $this->appartments;
    }

    public function addAppartment(Appartment $appartment): self
    {
        if (!$this->appartments->contains($appartment)) {
            $this->appartments->add($appartment);
            $appartment->setAddBy($this);
        }

        return $this;
    }

    public function removeAppartment(Appartment $appartment): self
    {
        if ($this->appartments->removeElement($appartment)) {
            // set the owning side to null (unless already changed)
            if ($appartment->getAddBy() === $this) {
                $appartment->setAddBy(null);
            }
        }

        return $this;
    }
}
