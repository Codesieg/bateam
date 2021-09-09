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

          // on retourne le resultat 
        return $this->json($allMovies,  201, [],
        );
    }

    /**
     * @Route("/yearsOfproduction", name="read", methods={"GET"})
     */
    public function browseYearsOfproduction(Request $request)
    {
        // $year = "2004";
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
        }
        // dd($year);
        $getMovies = file_get_contents("./data/movies.json");
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
     * @Route("/browseSearch", name="read", methods={"GET"})
     */
    public function browseSearch()
    {
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 

        $allMovies = array();
        foreach ($movies as $movie) {
            $movieName = stristr($movie["nom"], $search);
            $movieDirector = stristr($movie["realisateur"] , $search);
            
            if ($movieDirector || $movieName){
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
        // dd($allMovies);
        if ($allMovies == null) {
             // Si $allMovies ne retrourne aucun résultats on retourne le message suivant
            $allMovies[] = "Aucun résultat !";
            return $this->json($allMovies,  201, [],);
        }
            // on retourne le resultat 
            return $this->json($allMovies,  201, [],);
    }
}
