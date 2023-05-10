<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit', methods: ['GET'])]
    public function index(ProduitRepository $repo): Response
    {
        $tableau = $repo->findAll();

        return $this->render('produit.html.twig', [
            "produits" => $tableau
        ]);
    }
}
