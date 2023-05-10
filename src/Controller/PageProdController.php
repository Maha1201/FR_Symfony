<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageProdController extends AbstractController
{
    #[Route('/pageProd', name: 'app_pProd', methods: ['GET'])]
    public function index(ProduitRepository $repo): Response
    {
        $tableau = $repo->findAll();

        return $this->render('pageProd.html.twig', [
            "produits" => $tableau
        ]);
    }
}