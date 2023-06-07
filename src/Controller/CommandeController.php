<?php

namespace App\Controller;

use DateTime;
use App\Entity\Panier;
use App\Entity\Commande;
use App\Form\CommandeAdressesType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commande')]
class CommandeController extends AbstractController
{
    #[Route('/adresses', name: 'app_adresses')]
    public function adresses(CommandeRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $session = $request->getSession();
        $form = $this->createForm(CommandeAdressesType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $data = $form->getData();;
            $session->set("adresse1", $data["adresseLivraison"]);
            $session->set("adresse2", $data["adresseFacturation"]);
            dd($data);
            $this->redirect("etapesuivante");
        }


        return $this->render('commande/adresses.html.twig', [
            'form' => $form,
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
            //'commande' => $comm,
        ]);
    }
}
