<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
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

        $monopoly = new Product();
        $monopoly-> setName('Monopoly');
        $monopoly-> setPrice('50');
        $monopoly-> setDescription("Jeu où on peut être très riche dans être vraiment riche");
        $monopoly->setCategory($this->getReference(CategoryFixtures::CATEGORY_TOYS));
        $manager-> persist($monopoly);

        $nintendoSwitch = new Product();
        $nintendoSwitch-> setName('Nintendo Switch');
        $nintendoSwitch-> setPrice('300');
        $nintendoSwitch-> setDescription("Console portable de Nintendo");
        $nintendoSwitch->setCategory($this->getReference(CategoryFixtures::CATEGORY_GAMING));
        $manager-> persist($nintendoSwitch);

        

        $manager->flush();
    }
    public function getDependencies(): array {
        return [CategoryFixtures::class];
    }
}
