<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use Doctrine\Common\Persistence\ObjectManager;

class ModeleFixture extends BaseFixture
{

    public function __construct()
    {

    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Modele::class, function(Modele $user, $i) {

            $user->setLibelle(sprintf('AilFaune%d', $i));
            
        });

        $manager->flush();
    }
}
