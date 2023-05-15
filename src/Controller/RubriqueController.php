<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Repository\RubriqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RubriqueController extends AbstractController
{
    #[Route('/rubrique', name: 'app_rubrique', methods: ['GET'])]
    public function index(RubriqueRepository $repo): Response
    {
        $tableau = $repo->findAll();

        return $this->render('rubrique/index.html.twig', [
            "rubriques" => $tableau
        ]);
    }

    #[Route('/rubrique/{id}', name: 'app_rubrique_show', methods: ['GET'])]
    public function show(Rubrique $rubrique): Response
    {

        return $this->render('rubrique/rubrique_show.html.twig', [
            "rubriques" => $rubrique
        ]);
    }
}
