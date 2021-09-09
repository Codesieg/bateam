<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Movies;
use App\Entity\Nationalities;
use App\Data\SearchData;
use App\Form\SearchForm;


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
            $allMovies[] = self::addMovies($movie);
            $years[] = arsort($allMovies["years"]);
            $lastBroadcast[] = ($allMovies["lastBroadcast"]);
            $nationalities[] = ($allMovies["nationalities"]);
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
        // $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $getMovies = file_get_contents("./movies.json");
        $movies = json_decode($getMovies, true); 
        $search = $request->query->all();
        // dd($search);

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
            }
        }

        if ($allMovies == null) {
        // Si $allMovies ne retrourne aucun résultats on retourne le message suivant
            $allMovies[] = "Aucun résultat !";
            return $this->json($allMovies,  201, [],);
        }
        // on retourne le resultat 
            return $this->json($allMovies,  201, [],);

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
        $allMovies[] = $NewMovie;
        $allMovies["nationalities"] = $movie["nationalite"];
        $allMovies["years"] = $movie["annee_production"];
        $allMovies["lastBroadcast"] = $movie["derniere_diffusion"];
        
        return $allMovies;
    }
}
