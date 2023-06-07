<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Rubrique;
use App\Entity\Adresse;
use DateTimeImmutable;
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

        $u1 = new User;
        $u1->setEmail("abdalla.m1201@gmail.com")
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword('$2y$13$YUzgMMq7/3TAvipIX5UfI.T2QL7PnlxRapnzQlslk/KBkVDFMz2Ma')
            ->setIsVerified("1");
        $manager->persist($u1);

        $u2 = new User;
        $u2->setEmail("devtest.maha@gmail.com")
            ->setPassword('$2y$13$scby.gCWBV5Ck3g0IPLhfuWRZfQU2fN8zEiIlk6eGDL/sTjecct8G')
            ->setIsVerified("1");
        $manager->persist($u2);

        $c1 = new Client;
        $c1->setReference("000001")
            ->setCategorie("Particulier")
            ->setNom("Ma")
            ->setPrenom("Ha")
            ->setTelephone("0612345678");
        $c1->setUser($u1);
        $manager->persist($c1);

        $c2 = new Client;
        $c2->setReference("000002")
            ->setCategorie("Professionnel")
            ->setNom("Ma")
            ->setPrenom("Hou")
            ->setTelephone("0612345678");
        $c2->setUser($u2);
        $manager->persist($c2);

        $al1 = new Adresse;
        $al1->setRue("236")
            ->setIntitule("Pierre Curie")
            ->setVille("Reims")
            ->setPays("France")
            ->setCp("51454")
            ->setComplement("Apt 45");
        $al1->setClient($c1);
        $manager->persist($al1);

        $al2 = new Adresse;
        $al2->setRue("23")
            ->setIntitule("Pierre Curie 02")
            ->setVille("Reims")
            ->setPays("France")
            ->setCp("51454")
            ->setComplement("Apt 4");
        $al2->setClient($c1);
        $manager->persist($al2);

        $al3 = new Adresse;
        $al3->setRue("8")
            ->setIntitule("Jean Moulin")
            ->setVille("Reims")
            ->setPays("France")
            ->setCp("51454")
            ->setComplement("Apt 16245");
        $al3->setClient($c2);
        $manager->persist($al3);

        $al4 = new Adresse;
        $al4->setRue("564")
            ->setIntitule("Marie Curie")
            ->setVille("Amiens")
            ->setPays("France")
            ->setCp("84613");
        $al4->setClient($c2);
        $manager->persist($al4);

        $com1 = new Commande;
        $com1->setMoyenPaiement("Carte bancaire")
            ->setDate(new DateTimeImmutable());
        $com1->setClient($c1);
        $manager->persist($com1);

        //$p1->addRubrique($rub);
        //$p2->addRubrique($rub2);
        //$p3->addRubrique($rub3);

        $manager->flush();
    }
}
