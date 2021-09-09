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
        
        $getMovies = file_get_contents("./movies.json");
        $movies = json_decode($getMovies, true); 

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        dump($form);
        $nationality = array();
        $allMovies = array();
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
            if (!in_array($newMovie->getNationalite(), $nationality)) {
            $nationality[] = $newMovie->getNationalite();
            }
            dump($nationality);
        // foreach ($allMovies as $movie) {
        //     if (!in_array($movie->getNationalite(), $nationality)) {
        //         // dump($nationality);
        //         // $newNationality = new Nationalities();
        //         // $newNationality->setName($movie["nationalite"]);
        //         // $nationalities[] = $newNationality;
        //         // $nationality[] = $newNationality->getName();
        //         $nationalities[] = $nationality;
        //         dump($nationalities);
        //     }
        // }
            
            
            
        }
        // dd($nationalities);
        // return $this->json($allMovies,  201, [],
        // );

        return $this->render('base.html.twig', [
            'form' => $form->createView(),
            'allMovies' => $allMovies,
            'nationality' => $nationality,
    ]);
    }

    /**
     * @Route("/yearsOfproduction", name="read", methods={"GET"})
     */
    public function browseYearsOfproduction(Request $request)
    {
        // $year = "2004";
        $data = new SearchData();
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
