<?php

namespace App\Entity;

use App\Repository\MaterielsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=MaterielsRepository::class)
 * @UniqueEntity(fields={"materiel_id"})
 */
class Materiels
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
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prixPublic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenceFabricant;

    /**
     * @ORM\ManyToOne(targetEntity=Types::class, inversedBy="materiels", cascade={"persist"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $materielId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(?string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrixPublic(): ?string
    {
        return $this->prixPublic;
    }

    public function setPrixPublic(?string $prixPublic): self
    {
        $this->prixPublic = $prixPublic;

        return $this;
    }

    public function getReferenceFabricant(): ?string
    {
        return $this->referenceFabricant;
    }

    public function setReferenceFabricant(?string $referenceFabricant): self
    {
        $this->referenceFabricant = $referenceFabricant;

        return $this;
    }

    public function getType(): ?types
    {
        return $this->type;
    }

    public function setType(?types $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getMaterielId(): ?int
    {
        return $this->materielId;
    }

    public function setMaterielId(?int $materielId): self
    {
        $this->materielId = $materielId;

        return $this;
    }
}
