<?php

namespace App\Entity;

use App\Repository\AppartmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartmentRepository::class)]
class Appartment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    // #[ORM\Column(length: 255)]
    // private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $introduction = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?int $nbRoom = null;

    #[ORM\ManyToOne(inversedBy: 'appartments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?category $category = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'appartments')]
    private ?user $addBy = null;

    // #[ORM\ManyToOne(inversedBy: 'appartment', cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?user $addBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(?string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getNbRoom(): ?int
    {
        return $this->nbRoom;
    }

    public function setNbRoom(int $nbRoom): self
    {
        $this->nbRoom = $nbRoom;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    // public function getAddBy(): ?user
    // {
    //     return $this->addBy;
    // }

    // public function setAddBy(user $addBy): self
    // {
    //     $this->addBy = $addBy;

    //     return $this;
    // }

    public function getAddBy(): ?user
    {
        return $this->addBy;
    }

    public function setAddBy(?user $addBy): self
    {
        $this->addBy = $addBy;

        return $this;
    }
}
