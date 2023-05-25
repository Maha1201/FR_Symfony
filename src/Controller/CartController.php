<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];

            $total += $produit->getPrix() * $quantite;
        }

        // ['controller_name' => 'CartController',] était là de base à la place du compact
        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session): Response
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session): Response
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {

            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(SessionInterface $session): Response
    {
        $session->remove("panier");

        return $this->redirectToRoute('app_cart');
    }
}
