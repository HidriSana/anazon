<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CategoryFixtures extends Fixture 
{
    public const CATEGORY_HIGHTECH= "CATEGORY_HIGHTECH";
    public const CATEGORY_TOYS = "CATEGORY_TOYS";
    public const CATEGORY_CLOTHING = "CATEGORY_CLOTHING";
    public const CATEGORY_GAMING = "CATEGORY_GAMING";

    public function load(ObjectManager $manager): void
    {
        $toys = new Category();
        $toys->setName('Toys');
        $manager->persist($toys);
        $this->addReference(self::CATEGORY_TOYS, $toys);

        $clothing = new Category();
        $clothing ->setName('Clothing');
        $manager->persist($clothing);
        $this->addReference(self::CATEGORY_CLOTHING, $clothing);

        $hightech = new Category();
        $hightech -> setName('Hightech');
        $manager ->persist($hightech);
        $this->addReference(self::CATEGORY_HIGHTECH, $hightech);

        $gaming = new Category();
        $gaming-> setName('Gaming');
        $gaming-> setParent($hightech);
        $manager->persist($gaming);
        $this->addReference(self::CATEGORY_GAMING, $gaming);


    
        $manager->flush();
    }
}
