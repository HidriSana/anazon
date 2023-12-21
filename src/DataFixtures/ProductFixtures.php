<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Migrations\Exception\DependencyException;
use Doctrine\Persistence\ObjectManager;


class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $iphone13 = new Product();
        $iphone13-> setName('Iphone13');
        $iphone13-> setPrice('500');
        $iphone13-> setDescription("Description de l'iphone 13");
        $iphone13->setCategory($this->getReference(CategoryFixtures::CATEGORY_HIGHTECH));
        $manager-> persist($iphone13);

        $manager->flush();
    }
    public function getDependencies(): array {
        return [CategoryFixtures::class];
    }
}
