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
     * @Route("/yearsOfproduction", name="read", methods={"GET"})
     */
    public function browseYearsOfproduction(Request $request)
    {
        $year = "2004";
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
        }
        // dd($year);
        $getMovies = file_get_contents("./movies.json");
        $movies = json_decode($getMovies, true); 


        foreach ($movies as $movie) {
            // dump($movie["annee_production"]);
            if ($movie["annee_production"] == $year) {
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

            }


        }


        // dd($allMovies);
        if ($allMovies == null) {
             // Si $allMovies ne retrourne aucun r??sultats on retourne le message suivant
            $allMovies[] = "Aucun r??sultat !";
            return $this->json($allMovies,  201, [],);
        //     return $this->render('base.html.twig', [
        //         'allMovies' => $allMovies,
        // ]);
        }
            // on retourne le resultat 
            return $this->json($allMovies,  201, [],);
        //     return $this->render('base.html.twig', [
        //         'allMovies' => $allMovies,
        // ]);
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
