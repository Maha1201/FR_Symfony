<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rub = new Rubrique("Mariage");
        $manager->persist($rub);
        $this->addReference("Mariage", $rub);

        $rub2 = new Rubrique("Deuil");
        $manager->persist($rub2);
        $this->addReference("Deuil", $rub2);

        $rub3 = new Rubrique("Anniversaire");
        $manager->persist($rub3);
        $this->addReference("Anniversaire", $rub3);

        $rub4 = new Rubrique("Amour");
        $manager->persist($rub4);
        $this->addReference("Amour", $rub4);

        $p1 = new Produit;
        $p1->setNom("fleur1")
            ->setDescription("Descriptoin")
            ->setPrix(12)
            ->setPhoto("https://www.foliflora.fr/static/photos/bouquet-roses-rouges.jpg")
            ->setQuantiteTotale(30);
        $p1->addRubrique($this->getReference("Amour"));
        $manager->persist($p1);


        $p2 = new Produit;
        $p2->setNom("fleur2")
            ->setDescription("Description")
            ->setPrix(12)
            ->setPhoto("https://orchisartisanfleuriste.store/wp-content/uploads/2020/05/bouquet_roses_rouges_haut_4654.jpg")
            ->setQuantiteTotale(30);
        $p2->addRubrique($this->getReference("Deuil"));
        $manager->persist($p2);


        $p3 = new Produit;
        $p3->setNom("fleur3")
            ->setDescription("Descriptoin")
            ->setPrix(12)
            ->setPhoto("https://cdn.shopify.com/s/files/1/0273/7415/7961/products/bouquet-de-pivoines-artificielles-rose_1200x1200.png?v=1615983423")
            ->setQuantiteTotale(30);
        $p3->addRubrique($this->getReference("Amour"));
        $manager->persist($p3);

        $p4 = new Produit;
        $p4->setNom("fleur6432")
            ->setDescription("Descriptoin")
            ->setPrix(12)
            ->setPhoto("https://fleurs2saison.fr/wp-content/uploads/2020/04/ca8eb396ce7a6a3fd46b1646673a14d3.jpg")
            ->setQuantiteTotale(30);
        $p4->addRubrique($rub);
        $p4->addRubrique($rub2);
        $p4->addRubrique($rub3);
        $p4->addRubrique($rub4);
        $manager->persist($p4);

        $p5 = new Produit;
        $p5->setNom("fleur 653")
            ->setDescription("Description")
            ->setPrix(12)
            ->setPhoto("https://www.francefleurs.com/14860-large_default/bouquet-niagara.jpg")
            ->setQuantiteTotale(30);
        $p5->addRubrique($rub);
        $p5->addRubrique($rub2);
        $p5->addRubrique($rub3);
        $p5->addRubrique($rub4);
        $manager->persist($p5);






        //$u1 = new User;
        //$u1->setEmail("abdalla.m1201@gmail.com")
        //    ->setRoles(["ROLE_ADMIN"])
        //    ->setPassword("120198")
        //    ->setIsVerified("1");

        //$c1 = new Client;
        //$c1->setReference("000001")
        //    ->setCategorie("Particulier")
        //    ->setNom("Ma")
        //    ->setPrenom("Ha")
        //    ->setTelephone("0612345678");
        //$c1->setUser($u1);
        //$manager->persist($c1);






        //$p1->addRubrique($rub);
        //$p2->addRubrique($rub2);
        //$p3->addRubrique($rub3);

        $manager->flush();
    }
}
