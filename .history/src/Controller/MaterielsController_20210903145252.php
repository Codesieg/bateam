<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="movies_")
 */
class MoviessController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse()
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $getMovies = file_get_contents("./data/movies.json");
        $movies = json_decode($getMovies, true); 
        return $this->render('base.html.twig', [
            'movies' => $movies,
            'search' => $search
        ]);
    }

    /**
     * @Route("/movies/read", name="read", methods={"POST"})
     */
    public function read()
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
        $nationality = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
        $LastBroadCast = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);

        $getMovies = file_get_contents("./data/movies.json");

        if ($materiels == null) {
            return $this->redirectToRoute('materiels_browse');
        }
        return $this->render('base.html.twig', [
            'movie' => $movie,
            
        ]);
    }

    
}
