<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterielsRepository;
use App\Repository\TypesRepository;
use App\Entity\Materiels;
use App\Entity\Metiers;
use App\Entity\Types;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/", name="materiels_")
 */
class MaterielsController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(MaterielsRepository $materielsRepository, TypesRepository $typesRepository, PaginatorInterface $paginator, Request $request  ): Response
    {

        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $marques = $materielsRepository->findAllDisinct();
        $types = $typesRepository->findAll();

        $famille = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
        $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);

        $materiels = $paginator->paginate(
            $materielsRepository->findAllWithType(),
            $request->query->getInt('page', 1),
            25
        );

        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
            'marques' => $marques,
            'familleChoisi' => $famille,
            'marqueChoisi' => $marque,
            'search' => $search
        ]);
    }

    /**
     * @Route("/materiels/read", name="read", methods={"POST"})
     */
    public function read(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $famille = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
        $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
        $materiels = $materielsRepository->findAllWithTypeId($famille, $marque);
        $types = $typesRepository->findAll();
        $marques = $materielsRepository->findAllDisinct();

        if ($materiels == null) {
            return $this->redirectToRoute('materiels_browse');
        }
        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
            'marques' => $marques,
            'familleChoisi' => $famille,
            'marqueChoisi' => $marque,
            'search' => $search
        ]);
    }

    /**
     * @Route("/materiels/import", name="import", methods={"GET"},)
     */
    public function import(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
       
        $httpClient = HttpClient::create();
        $token = "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0b2tlbiI6IjlSWVRsc0dzQkJUZ2RTdTdYUG9JM2V5NzB4RXZqa0hGRmNQU1drOGFwWVptRnpqTmRkeWN2ZWpmYVRnQXRmVFUyMDkiLCJzdWIiOjIwOSwiaXNzIjoiaHR0cHM6Ly9wcmVwcm9kLnN0YXJpZi5jcmlzdGFsY3JtLmZyIiwiaWF0IjoxNjAzOTYxMjk0LCJleHAiOjQ3NTc1NjEyOTQsIm5iZiI6MTYwMzk2MTI5NCwianRpIjoiV0M3UzlJMmxkZmZCcEFuVyJ9.2lv_XQZk8PXUEMhpz6mDs-C02FcRRKTjz06ys3zsioU";


        $response = $httpClient->request('GET', 'https://preprod.starif.cristalcrm.fr/api/materiels' . $token);
        $content = $response->getContent();
        $content = json_decode($content, true);
        $nbPages =  $content['last_page'];
        // dd($content);
        for ($i = 1; $i < $nbPages; $i++) {
            $response = $httpClient->request('GET', 'https://preprod.starif.cristalcrm.fr/api/materiels' . $token . "&query=&page=" . $i);
            $content = $response->getContent();
            $content = json_decode($content, true);
            $allContent['page' . $i] = $content['data'];
        }
        // $allContent = $content['data'];
        foreach ($allContent as $page) {
            foreach ($page as $NewMateriel) {
                // dd($allContent, $NewMateriel);
                // dd($NewMateriel['materiel_id']);
                $materiel = new Materiels();
                $type = new Types();
                $metier = new Metiers();

                // Je dois controler si le materiel existe déja
                $materielExist = $materielsRepository->findBy(['materielId' => $NewMateriel['materiel_id']]);
                // si il n'existe pas je récupére l'id de la famille équivalent et le nom de mon materiel
                if (!$materielExist) {
                    $materiel->setMaterielId($NewMateriel['materiel_id']);
                    $materiel->setNomCourt($NewMateriel['nom_court']);
                    $materiel->setMarque($NewMateriel['marque']);
                    $materiel->setPrixPublic($NewMateriel['prix_public']);
                    $materiel->setReferenceFabricant($NewMateriel['reference_fabricant']);
                    $materiel->setCommentaire($NewMateriel['commentaire']);

                    $typeExist = $typesRepository->findBy(['famille' => $NewMateriel['type']['famille']]);
                    if ($typeExist) {
                        $idType = $typeExist[0]->getId();
                        $typeExistId =  $typesRepository->find($idType);
                        $materiel->setType($typeExistId);
                    } else {
                        $materiel->setType($type);
                        $type->setFamille($NewMateriel['type']['famille']);
                        $type->setNom($NewMateriel['type']['nom']);
                        $type->setMetier($metier);
                        $metier->setNom($NewMateriel['type']['metier']['nom']);
                    }

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($materiel);
                    $em->flush();
                }
            }
        }
        return $this->redirectToRoute('materiels_browse');
    }
}
