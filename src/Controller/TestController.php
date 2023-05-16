<?php

namespace App\Controller;

use App\Entity\Rubrique;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/{rubrique}', name: 'app_test')]
    public function index(Rubrique $rubrique): Response
    {

        // foreach ($rubrique->getProduits() as $p) {
        //     echo $p->getNom();
        // }
        dd($rubrique);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
