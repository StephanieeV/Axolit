<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use App\Entity\TypeAnnonce;
use Doctrine\Common\Persistence\ObjectManager;

class TypeAnnonceFixture extends BaseFixture
{

    public function __construct()
    {

    }

    protected function loadData(ObjectManager $manager)
    {
        $typeannonce= new TypeAnnonce();
        $typeannonce->setLibelle('A vendre');

        $this->addReference( TypeAnnonce::class.'SAX'.'1', $typeannonce);

        $typeannonce2= new TypeAnnonce();
        $typeannonce2->setLibelle('À réparer');
        $this->addReference( TypeAnnonce::class.'SAX2', $typeannonce2);

        
        $this->manager->persist($typeannonce);
        $this->manager->persist($typeannonce2);


        $manager->flush();
    }
}
