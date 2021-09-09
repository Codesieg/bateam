<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
{

    
    private $nom;
    
    private $realisateur;
    
    private $annee_production;
    
    private $nationalite;
    
    private $derniere_diffusion;
    
    private $nb_diffusion;
    
    private $nb_premiere_partie;

    private $moyenne_diffusion_par_an;

    private $nationalities;

    private $ratio;

    private $bestDirector;

    
    // _____   _____   _____   _____   _____   _____   
    // /  ___| | ____| |_   _| |_   _| | ____| |  _  \  
    // | |     | |__     | |     | |   | |__   | |_| |  
    // | |  _  |  __|    | |     | |   |  __|  |  _  /  
    // | |_| | | |___    | |     | |   | |___  | | \ \  
    // \_____/ |_____|   |_|     |_|   |_____| |_|  \_\ 

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function getAnneeProduction(): ?string
    {
        return $this->annee_production;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function getDerniereDiffusion(): ?int
    {
        return $this->derniere_diffusion;
    }

    public function getNbDiffusion(): ?int
    {
        return $this->nb_diffusion;
    }

    public function getNbPremierePartie(): ?int
    {
        return $this->nb_premiere_partie;
    }

    public function getMoyenneDiffusionParAn(): ?int
    {
        return $this->moyenne_diffusion_par_an;
    }

    public function getRatio(): ?int
    {
        return $this->ratio;
    }


    // _____   _____   _____   _____   _____   _____   
    // /  ___/ | ____| |_   _| |_   _| | ____| |  _  \  
    // | |___  | |__     | |     | |   | |__   | |_| |  
    // \___  \ |  __|    | |     | |   |  __|  |  _  /  
    //  ___| | | |___    | |     | |   | |___  | | \ \  
    // /_____/ |_____|   |_|     |_|   |_____| |_|  \_\ 


    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setRealisateur(?string $realisateur): self
    {
        $this->realisateur = $realisateur;
        return $this;
    }

    public function setAnneeProduction(?string $annee_production): self
    {
        $this->annee_production = $annee_production;
        return $this;
    }

    public function setNationalite(?string $nationalite): self
    {
        $this->nationalite = $nationalite;
        return $this;
    }

    public function setDerniereDiffusion(?string $derniere_diffusion): self
    {
        $this->derniere_diffusion = $derniere_diffusion;
        return $this;
    }

    public function setNbDiffusion(?string $nb_diffusion ): self
    {
        $this->nb_diffusion = $nb_diffusion;
        return $this;
    }

    public function setNbPremierePartie(?string $nb_premiere_partie): self
    {
        $this->nb_premiere_partie = $nb_premiere_partie;
        return $this;
    }

    public function setMoyenneDiffusionParAn(?string $moyenne_diffusion_par_an): self
    {
        $this->moyenne_diffusion_par_an = $moyenne_diffusion_par_an;
        return $this;
    }

    public function getNationalities(): ?Nationalities
    {
        return $this->nationalities;
    }

    public function setNationalities(?Nationalities $nationalities): self
    {
        $this->nationalities = $nationalities;

        return $this;
    }

}
