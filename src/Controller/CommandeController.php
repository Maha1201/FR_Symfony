<?php

namespace App\Controller;

use DateTime;
use App\Entity\Panier;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/phase1', name: 'app_phase1')]
    public function phase1(CommandeRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $commande = $repo->findAll();
        $session = $request->getSession();

        $panier = $session->get("panier", []);

        dump($panier);

        $commande = new Commande();
        $commande->setDate(new DateTime());
        // $commande->setClient();

        foreach ($panier as $id => $quantite) {
            $panier = new Panier();

            $panier->setProduit($id);
            $panier->setQuantite($quantite);
            $panier->setCommande($commande);
            $manager->persist($panier);
        }

        $manager->persist($commande);
        $manager->flush();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
            //'commande' => $comm,
        ]);
    }

   


    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $commande = $repo->findAll();
        $session = $request->getSession();

        $panier = $session->get("panier", []);

        dump($panier);

        $commande = new Commande();
        $commande->setDate(new DateTime());
        // $commande->setClient();

        foreach ($panier as $id => $quantite) {
            $panier = new Panier();

            $panier->setProduit($id);
            $panier->setQuantite($quantite);
            $panier->setCommande($commande);
            $manager->persist($panier);
        }

        $manager->persist($commande);
        $manager->flush();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
            //'commande' => $comm,
        ]);
    }
}
