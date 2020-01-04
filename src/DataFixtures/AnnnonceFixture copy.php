<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\TypeAnnonce;
use App\Entity\TypeAppareil;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class AnnonceFixture extends BaseFixture
{

    public function __construct()
    {
 }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Annonce::class, function(Annonce $annonce, $i) {

            $annonce->setTitre(sprintf('Annonce N°%d', $i));
            $annonce->setPrix($i);
            $annonce->setTexteAnnonce("Un superbe appareil. Forgé à partir de mithril");
            $annonce->setModele($this->getRandomReference('modele'));
            $annonce->setLocalisation("New Monbasa");
            $annonce->setModele($this->getRandomReference(TypeAnnonce::class));
            $annonce->setModele($this->getRandomReference(TypeAppareil::class));
            $annonce->setUser($this->getRandomReference(User::class));






            return $annonce;
        });

        $manager->flush();
    }
}
