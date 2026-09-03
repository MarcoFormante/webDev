<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DisableAutoMapping;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $stack = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionIT = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionFR = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionEN = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }


    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getStack(): ?string
    {
        return $this->stack;
    }

    public function setStack(string $stack): static
    {
        $this->stack = $stack;

        return $this;
    }

    public function getDescriptionIT(): ?string
    {
        return $this->descriptionIT;
    }

    

    public function setDescriptionIT(string $descriptionIT): static
    {
        $this->descriptionIT = $descriptionIT;

        return $this;
    }


    public function getDescriptionFR(): ?string
    {
        return $this->descriptionFR;
    }

    

    public function setDescriptionFR(string $descriptionFR): static
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }


    public function getDescriptionEN(): ?string
    {
        return $this->descriptionEN;
    }

    

    public function setDescriptionEN(string $descriptionEN): static
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    #[DisableAutoMapping]
    public function getDescription(string $_locale){
        $description = $this->getDescriptionIT();
        switch ($_locale) {
            case 'it':
                $description = $this->descriptionIT;
                break;

            case 'fr':
                $description = $this->descriptionFR;
                break;


            case 'en':  
                $description = $this->descriptionEN;
                break;

            
            default:
                $description = $this->descriptionIT;
                break;
        }
        return $description;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $createdAt): static
    {
        $this->updatedAt = $createdAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
