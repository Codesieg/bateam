<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movies;


/**
 * @Route("/", name="movies_")
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse()
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $getMovies = file_get_contents("./data/movies.json");
        // $movies = json_decode($getMovies, true); 
        $movies = json_decode($getMovies, true); 

        

        foreach ($movies as $movie) {
            $NewMovie = new Movies();
            $NewMovie->setNom($movie["nom"]);
            $NewMovie->setRealisateur($movie["realisateur"]);
            $NewMovie->SetAnneeProduction($movie["annee_production"]);
            $NewMovie->setNationalite($movie["nationalite"]);
            $NewMovie->setDerniereDiffusion($movie["derniere_diffusion"]);
            $NewMovie->setNbDiffusion($movie["nb_diffusion"]);
            $NewMovie->setNbPremierePartie($movie["nb_premiere_partie"]);
            $NewMovie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);
            
            $allMovies[] = $NewMovie;
        } 
        foreach ($allMovies as $movie) {
            $moviesByYear[] = $allMovies["annee_production"];
            $lastBroadCasts[] = $allMovies["derniere_diffusion"];
            $nationalities[] = $allMovies["nationalite"];
        } 

        arsort($moviesByYear);

        return $this->render('base.html.twig', [
            'allMovies' => $allMovies,
            'search' => $search,
            'lastBroadCasts' => array_unique($lastBroadCasts),
            'nationalities' => array_unique($nationalities),
            'moviesByYear' => array_unique($moviesByYear),
        ]);
    }

    /**
     * @Route("/movies/read", name="read", methods={"POST"})
     */
    public function read()
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
        $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastBroadCast = filter_input(INPUT_POST, 'lastBroadCast', FILTER_SANITIZE_SPECIAL_CHARS);

        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 

        foreach ($movies as $movie) {
            $moviesByYear[] = $movie["annee_production"];
            $lastBroadCasts[] = $movie["derniere_diffusion"];
            $nationalities[] = $movie["nationalite"];
        } 

        if ($movies == null) {
            return $this->redirectToRoute('materiels_browse');
        }
        return $this->render('base.html.twig', [
            'resultsByYear' => $movies,
            
        ]);
    }

    
}
