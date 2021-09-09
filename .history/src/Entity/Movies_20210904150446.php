<?php

namespace App\Entity;


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

    public function __construct($nom = '', $realisateur = '', $annee_production = '', $nationalite = '', $derniere_diffusion = '', $nb_diffusion = '', $nb_premiere_partie = '', $moyenne_diffusion_par_an = '') {
        $this->nom = $nom;
        $this->realisateur = $realisateur;
        $this->annee_production = $annee_production;
        $this->nationalite = $nationalite;
        $this->derniere_diffusion = $derniere_diffusion;
        $this->nb_diffusion = $nb_diffusion;
        $this->nb_premiere_partie = $nb_premiere_partie;
        $this->moyenne_diffusion_par_an = $moyenne_diffusion_par_an;
    }

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

    public function getDerniereDiffusion(): ?string
    {
        return $this->derniere_diffusion;
    }

    public function getNbDiffusion(): ?string
    {
        return $this->nb_diffusion;
    }

    public function getNbPremierePartie(): ?string
    {
        return $this->nb_premiere_partie;
    }

    public function getMoyenneDiffusionParAn(): ?string
    {
        return $this->moyenne_diffusion_par_an;
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
}
