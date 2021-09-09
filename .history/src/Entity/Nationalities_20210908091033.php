<?php

namespace App\Entity;


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
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
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
        dump($name);
        return $this;
    }

    /**
     * @return Collection|Movies[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovies(Movies $movies): self
    {
        if (!$this->movies->contains($movies)) {
            $this->movies[] = $movies;
            $movies->setNationalities($this);
        }

        return $this;
    }

    public function removeMovies(Movies $movies): self
    {
        if ($this->movies->removeElement($movies)) {
            // set the owning side to null (unless alreadmovies changed)
            if ($movies->getNationalities() === $this) {
                $movies->setNationalities(null);
            }
        }

        return $this;
    }
}
