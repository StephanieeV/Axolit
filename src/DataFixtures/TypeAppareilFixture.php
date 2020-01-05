<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use App\Entity\TypeAppareil;
use Doctrine\Common\Persistence\ObjectManager;

class TypeAppareilFixture extends BaseFixture
{

    public function __construct()
    {

    }

    protected function loadData(ObjectManager $manager)
    {

        $typeannonce= new TypeAppareil();
        $typeannonce->setLibelle('Téléphone');

        $this->addReference( TypeAppareil::class.'SAX1', $typeannonce);

        $typeannonce2= new TypeAppareil();
        $typeannonce2->setLibelle('Tablette');

        $this->addReference( TypeAppareil::class.'SAX2', $typeannonce2);

        $typeannonce3= new TypeAppareil();
        $typeannonce3->setLibelle('Ordinateur');

        $this->addReference( TypeAppareil::class.'SAX3', $typeannonce3);


 
        
        $this->manager->persist($typeannonce);
        $this->manager->persist($typeannonce2);
        $this->manager->persist($typeannonce3);


        $manager->flush();
    }
}
