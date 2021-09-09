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
     * @Route("", name="browse", methods={"GET", "POST"})
     */
    public function index()
    {
        // $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        // $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
        // $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_SPECIAL_CHARS);
        // $lastBroadCast = filter_input(INPUT_POST, 'lastBroadCast', FILTER_SANITIZE_SPECIAL_CHARS);
        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 


        foreach ($movies as $movie) {
            $NewMovie = new Movies();
            $NewMovie->setNom($movie["nom"]);
            $NewMovie->setRealisateur($movie["realisateur"]);
            $NewMovie->setAnneeProduction($movie["annee_production"]);
            $NewMovie->setNationalite($movie["nationalite"]);
            $NewMovie->setDerniereDiffusion($movie["derniere_diffusion"]);
            $NewMovie->setNbDiffusion($movie["nb_diffusion"]);
            $NewMovie->setNbPremierePartie($movie["nb_premiere_partie"]);
            $NewMovie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);

            $allMovies[] = $NewMovie;
            // $moviesYear[] = $NewMovie->getAnneeProduction();
            // $nationalities[] = $NewMovie->getNationalite();
            // $lastBroadCasts[] = $NewMovie->getDerniereDiffusion();
        }
        // dd($allMovies);
        // if ($year != null) {
        //     // usort($allMovies, $year);
        //     foreach ($allMovies as $movie)
        //     if ($movie->getAnneeProduction() == $year) {
        //         $allMoviesFilter[] = $movie;
        //         dump($movie->getAnneeProduction(), $allMoviesFilter);
        //     }
        // }
        // // arsort($moviesYear);
        // asort($allMovies);

        // return $this->render('base.html.twig', [
        //     'allMovies' => $allMovies,
        //     'search' => $search,
        //     'lastBroadCasts' => array_unique($lastBroadCasts),
        //     'nationalities' => array_unique($nationalities),
        //     'moviesYear' => array_unique($moviesYear),
        // ]);

          // on retourne le resulta 
        return $this->json($allMovies,  201, [],
        );
    }

    /**
     * @Route("/years", name="read", methods={"GET"})
     */
    public function browseYears()
    {
        $year = "2004";

        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 


        foreach ($movies as $movie) {
            dd($movie["nom"]);
            if ($movie["nom"] == $year) {
                $NewMovie = new Movies();
                $NewMovie->setNom($movie["nom"]);
                $NewMovie->setRealisateur($movie["realisateur"]);
                $NewMovie->setAnneeProduction($movie["annee_production"]);
                $NewMovie->setNationalite($movie["nationalite"]);
                $NewMovie->setDerniereDiffusion($movie["derniere_diffusion"]);
                $NewMovie->setNbDiffusion($movie["nb_diffusion"]);
                $NewMovie->setNbPremierePartie($movie["nb_premiere_partie"]);
                $NewMovie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);

                $allMovies[] = $NewMovie;
            }
        }
            // on retourne le resulta 
            return $this->json($allMovies,  201, [],);
    }
    
}

//Avoir un script js qui realise la requete en ajax 