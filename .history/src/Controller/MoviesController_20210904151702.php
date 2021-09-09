<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



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
        $movies = json_decode($getMovies); 

        // foreach ($movies as $movie) {
        //     $moviesByYear[] = $movie["annee_production"];
        //     $lastBroadCasts[] = $movie["derniere_diffusion"];
        //     $nationalities[] = $movie["nationalite"];
        // } 

        foreach ($movies as $movie) {
            $movie->setNom($movie["nom"]);
            $movie->setRealisateur($movie["realisateur"]);
            $movie->SetAnneeProduction($movie["annee_production"]);
            $movie->setNationalite($movie["nationalite"]);
            $movie->DerniereDiffusion($movie["derniere_diffusion"]);
            $movie->setNbDiffusion($movie["nb_diffusion"]);
            $movie->setNbPremierePartie($movie["nb_premiere_partie"]);
            $movie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);
        } 


        arsort($moviesByYear);

        return $this->render('base.html.twig', [
            'movies' => $movies,
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
