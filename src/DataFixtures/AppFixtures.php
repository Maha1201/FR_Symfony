<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Rubrique;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rub = new Rubrique("Mariage");
        $manager->persist($rub);
        $this->addReference( "Mariage", $rub);

        $rub2 = new Rubrique("Deuil");
        $manager->persist($rub2);
        $this->addReference( "Deuil", $rub2);

        $rub3 = new Rubrique("Anniversaire");
        $manager->persist($rub3);
        $this->addReference( "Anniversaire", $rub3);

        $rub4 = new Rubrique("Amour");
        $manager->persist($rub4);
        $this->addReference( "Amour", $rub4);

        $p1 = new Produit("fleur1", "desrpctsion", 12, "https://www.foliflora.fr/static/photos/bouquet-roses-rouges.jpg", 30);
        $p1->addRubrique($this->getReference("Amour"));
        $manager->persist($p1);


        $p2 = new Produit("fleur2", "description", 12, "https://orchisartisanfleuriste.store/wp-content/uploads/2020/05/bouquet_roses_rouges_haut_4654.jpg", 30);
        $p2->addRubrique($this->getReference("Deuil"));
        $manager->persist($p2);
        

        $p3 = new Produit("fleur3", "description", 12, "https://cdn.shopify.com/s/files/1/0273/7415/7961/products/bouquet-de-pivoines-artificielles-rose_1200x1200.png?v=1615983423", 30);
        $p3->addRubrique($this->getReference("Amour"));
        $manager->persist($p3);
        
        //$p1->addRubrique($rub);
        //$p2->addRubrique($rub2);
        //$p3->addRubrique($rub3);

        $manager->flush();
    }
}
