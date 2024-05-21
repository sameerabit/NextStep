<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\ProvinceState;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $country = new Country();
        $country->setName('Sri Lanka');
        $manager->persist($country);
        $manager->flush();

        $province = new ProvinceState();
        $province->setCountry($country);
        $province->setName('Southern');

        $manager->persist($province);
        $manager->flush();
    }
}