<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, User::class, function(User $user, $i){
            $user->setEmail(sprintf('spacebar%d@example.com', $i));


            $arrX = array("Jotaro", "Giorno", "Josuke", "Joseph", "Moroder", "Giovanni", "Marduk", "Marwane","Merwan" );
            $randIndex = array_rand($arrX, 1);

            $user->setNom("Joestar");
            $user->setPrenom($arrX[$randIndex]);

            
            $user->setPseudo(sprintf('JoJo%d', $i));
            $user->setPhotoprofil('uneranddomstring');

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });

        $manager->flush();
    }
}
