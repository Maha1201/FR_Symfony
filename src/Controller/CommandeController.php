<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repo): Response
    {
        $commande = $repo->findAll();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
            //'commande' => $comm,
        ]);
    }
}
