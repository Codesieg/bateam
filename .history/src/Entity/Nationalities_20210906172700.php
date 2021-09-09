<?php

namespace App\Entity;

use App\Repository\NationalitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NationalitiesRepository::class)
 */
class Nationalities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Movies::class, mappedBy="nationalities")
     */
    private $y;

    public function __construct()
    {
        $this->y = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Movies[]
     */
    public function getY(): Collection
    {
        return $this->y;
    }

    public function addY(Movies $y): self
    {
        if (!$this->y->contains($y)) {
            $this->y[] = $y;
            $y->setNationalities($this);
        }

        return $this;
    }

    public function removeY(Movies $y): self
    {
        if ($this->y->removeElement($y)) {
            // set the owning side to null (unless already changed)
            if ($y->getNationalities() === $this) {
                $y->setNationalities(null);
            }
        }

        return $this;
    }
}
