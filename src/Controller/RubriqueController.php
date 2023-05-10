<?php

namespace App\Controller;

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

        return $this->render('rubrique.html.twig', [
            "rubriques" => $tableau
        ]);
    }
}
