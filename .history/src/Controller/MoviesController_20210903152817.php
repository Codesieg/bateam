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
        $movies = json_decode($getMovies, true); 
        foreach ($movies as $movie) {
            foreach ($movies["annee_production"] as $moviesYears){
                $moviesByYear['Movies'] = $moviesYears;
                dd($movies);
            }
        } 
        // $years = json_decode($movies["annee_production"], true); 
        return $this->render('base.html.twig', [
            'movies' => $movies,
            'search' => $search,
            'years' => $years,

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
        $LastBroadCast = filter_input(INPUT_POST, 'LastBroadCast', FILTER_SANITIZE_SPECIAL_CHARS);

        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 

        foreach ($movies["annee_production"] as $movie) {
            $moviesByYear[] = $movie;
        } 

        if ($movies == null) {
            return $this->redirectToRoute('materiels_browse');
        }
        return $this->render('base.html.twig', [
            'resultsByYear' => $movies,
            
        ]);
    }

    
}
