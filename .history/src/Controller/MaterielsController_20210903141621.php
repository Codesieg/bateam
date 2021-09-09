<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="materiels_")
 */
class MaterielsController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse()
    {
        // $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $getMovies = file_get_contents("movie.json");
        $movies = json_decode($getMovies, true); 




        return $this->render('base.html.twig', [
            'movies' => $movies

        ]);
    }

    // /**
    //  * @Route("/materiels/read", name="read", methods={"POST"})
    //  */
    // public function read(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    // {
    //     $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
    //     $famille = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
    //     $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
    //     $materiels = $materielsRepository->findAllWithTypeId($famille, $marque);
    //     $types = $typesRepository->findAll();
    //     $marques = $materielsRepository->findAllDisinct();

    //     if ($materiels == null) {
    //         return $this->redirectToRoute('materiels_browse');
    //     }
    //     return $this->render('base.html.twig', [
    //         'materiels' => $materiels,
    //         'types' => $types,
    //         'marques' => $marques,
    //         'familleChoisi' => $famille,
    //         'marqueChoisi' => $marque,
    //         'search' => $search
    //     ]);
    // }

    
}
