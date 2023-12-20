<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $iphone13 = new Product();
        $iphone13-> setName('Iphone13');
        $iphone13-> setPrice('500');
        $iphone13-> setDescription("Description de l'iphone 13");
        //La relation ici 
        $manager-> persist($iphone13);

        $manager->flush();
    }
}
