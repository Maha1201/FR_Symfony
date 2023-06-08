<?php

namespace App\Controller;

use DateTime;
use App\Entity\Panier;
use App\Entity\Commande;
use App\Entity\Produit;
use App\Form\CommandeAdressesType;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commande')]
class CommandeController extends AbstractController
{
    #[Route('/adresses', name: 'app_adresses')]
    public function adresses(CommandeRepository $repo, Request $request, EntityManagerInterface $manager, ProduitRepository $produitRepository): Response
    {
        $session = $request->getSession();
        $form = $this->createForm(CommandeAdressesType::class);

        $panier = $session->get("panier", []);

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

        $form->handleRequest($request);

        // && $form->isValid()
        if ($form->isSubmitted()) {

            $data = $form->getData();
            $session->set("adresse1", $data["adresseLivraison"]);
            $session->set("adresse2", $data["adresseFacturation"]);
            //dd($data);
            return $this->redirectToRoute("app_paiement");
        }


        return $this->render('commande/adresses.html.twig', [
            'form' => $form,
            'panier' => $dataPanier,
            'total' => $total,
        ]);
    }

    #[Route('/paiement', name: 'app_paiement')]
    public function paiement(Request $request, ProduitRepository $produitRepository): Response
    {
        $session = $request->getSession();

        $panier = $session->get("panier", []);

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

        return $this->render('commande/paiement.html.twig', [
            'panier' => $dataPanier,
            'total' => $total,
        ]);
    }


    #[Route('/validation', name: 'app_commande')]
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
        ]);
    }
}
