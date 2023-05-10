<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index(ProduitRepository $repo): Response
    {
        $tableau = $repo->findAll();

        return $this->render('index.html.twig', [
            "produits" => $tableau
        ]);
    }
}