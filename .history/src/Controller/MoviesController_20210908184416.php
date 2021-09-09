<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Movies;


/**
 * @Route("/", name="movies_")
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("", name="browse")
     */
    public function index(Request $request)
    {
        dump($request);
        $getMovies = file_get_contents("./movies.json");
        $movies = json_decode($getMovies, true); 

        foreach ($movies as $movie) {
            $newMovie = new Movies();
            $newMovie->setNom($movie["nom"]);
            $newMovie->setRealisateur($movie["realisateur"]);
            $newMovie->setAnneeProduction($movie["annee_production"]);
            $newMovie->setNationalite($movie["nationalite"]);
            $newMovie->setDerniereDiffusion($movie["derniere_diffusion"]);
            $newMovie->setNbDiffusion($movie["nb_diffusion"]);
            $newMovie->setNbPremierePartie($movie["nb_premiere_partie"]);
            $newMovie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);
            $allMovies[] = $newMovie;

            $nationalities[] = $movie["nationalite"];
            $years[] = $movie["annee_production"];
            $lastBroadcast[] = $movie["derniere_diffusion"];

            arsort($years);
            arsort($lastBroadcast);
        }
        // return $this->json($allMovies,  201, [],
        // );

        return $this->render('base.html.twig', [
            'allMovies' => $allMovies,
            'nationalities' =>array_unique($nationalities),
            'years' => array_unique($years),
            'lastBroadcast' => array_unique($lastBroadcast),
    ]);
    }

    /**
     * @Route("/browseSearch", name="browseSearch", methods={"GET"})
    */
    public function browseSearch(Request $request)
    {
        $getMovies = file_get_contents("./movies.json");
        $movies = json_decode($getMovies, true); 
        $search = $request->query->all();

        foreach ($movies as $movie) {
            if ($search["search"] != null) {
                    $movieName = stristr($movie["nom"], $search["search"]);
                    $movieDirector = stristr($movie["realisateur"] , $search["search"]);
                    if ($movieDirector || $movieName){                       
                        $allMovies[] = self::addMovies($movie);
                    }                   
            } else if ($search["year"] != null && $movie["annee_production"] == $search["year"]) {
                $allMovies[] = self::addMovies($movie);
            } else if ($search["lastBroadcast"] != null && $movie["derniere_diffusion"] == $search["lastBroadcast"]) {
                $allMovies[] = self::addMovies($movie);
            } else if ($search["nationality"] != null && $movie["nationalite"] == $search["nationality"]) {
                $allMovies[] = self::addMovies($movie);
            }

            $nationalities[] = $movie["nationalite"];
            $years[] = $movie["annee_production"];
            $lastBroadcast[] = $movie["derniere_diffusion"];
        }

        arsort($years);
        arsort($lastBroadcast);

        if ($allMovies == null) {
        // Si $allMovies ne retrourne aucun résultats on retourne le message suivant
        return $this->redirectToRoute('movies_browse');
        }
        // on retourne le resultat 
            // return $this->json($allMovies,  201, [],);

            return $this->render('base.html.twig', [
                'allMovies' => $allMovies,
                'nationalities' =>array_unique($nationalities),
                'years' => array_unique($years),
                'lastBroadcast' => array_unique($lastBroadcast),
        ]);

    }

    public static function addMovies($movie) {
        $NewMovie = new Movies();
        $NewMovie->setNom($movie["nom"]);
        $NewMovie->setRealisateur($movie["realisateur"]);
        $NewMovie->setAnneeProduction($movie["annee_production"]);
        $NewMovie->setNationalite($movie["nationalite"]);
        $NewMovie->setDerniereDiffusion($movie["derniere_diffusion"]);
        $NewMovie->setNbDiffusion($movie["nb_diffusion"]);
        $NewMovie->setNbPremierePartie($movie["nb_premiere_partie"]);
        $NewMovie->setMoyenneDiffusionParAn($movie["moyenne_diffusion_par_an"]);
        
        return $allMovies[] = $NewMovie;
    }
}
