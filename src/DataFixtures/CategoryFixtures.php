<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class CategoryFixtures extends Fixture 
{
    public const CATEGORY_HIGHTECH= "CATEGORY_HIGHTECH";

    public function load(ObjectManager $manager): void
    {
        $toys = new Category();
        $toys->setName('Toys');
        $manager->persist($toys);

        $clothing = new Category();
        $clothing ->setName('Clothing');
        $manager->persist($clothing);

        $hightech = new Category();
        $hightech -> setName('Hightech');
        $manager ->persist($hightech);
        $this->addReference(self::CATEGORY_HIGHTECH, $hightech);

        $gaming = new Category();
        $gaming-> setName('Gaming');
        $gaming-> setParent($hightech);
        $manager->persist($gaming);

    
        $manager->flush();
    }
}
