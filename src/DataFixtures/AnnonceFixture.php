<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\TypeAnnonce;
use App\Entity\TypeAppareil;
use App\Entity\User;
use App\Entity\Modele;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AnnonceFixture extends BaseFixture  implements DependentFixtureInterface
{

    public function __construct()
    {
 }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, Annonce::class, function(Annonce $annonce, $i) {

            $annonce->setTitre('Annonce'. $i);
            $annonce->setPrix($i);
            $annonce->setTexteAnnonce("Un superbe appareil. Forgé à partir de mithril");
            $annonce->setModele($this->getRandomReference(Modele::class));
            $annonce->setLocalisation("New Monbasa");
            $annonce->setTypeAppareil($this->getRandomReference(TypeAppareil::class));
            $annonce->setUser($this->getRandomReference(User::class));
            $annonce->setTypeAnnonce($this->getRandomReference(TypeAnnonce::class));






            return $annonce;
        });

        $manager->flush();
    }


    public function getDependencies()
    {
        return array(
            UserFixture::class,
            TypeAnnonceFixture::class,
            TypeAppareilFixture::class,
            ModeleFixture::class,
        );
    }
}
