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

    public function setRealisateur(): self
    {
        return $this->realisateur;
    }

    public function setAnneeProduction(): self
    {
        return $this->annee_production;
    }

    public function setNationalite(): self
    {
        return $this->nationalite;
    }

    public function setDerniereDiffusion(): self
    {
        return $this->derniere_diffusion;
    }

    public function setNbDiffusion(): self
    {
        return $this->nb_diffusion;
    }

    public function setNbPremierePartie(): self
    {
        return $this->nb_premiere_partie;
    }

    public function setMoyenneDiffusionParAn(): self
    {
        return $this->moyenne_diffusion_par_an;
    }
}
