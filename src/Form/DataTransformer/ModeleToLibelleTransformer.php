<?php
namespace App\Form\DataTransformer;

use App\Entity\Modele;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ModeleToLibelleTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (modelle) to a string (libelle).
     *
     * @param  Modele|null $issue
     * @return string
     */
    public function transform($modele)
    {
        if (null === $modele) {
            return '';
        }

        return $modele->getId();
    }

    /**
     * Transforms a string (libelle) to an object (modele).
     *
     * @param  string $issueNumber
     * @return Modele|null
     * @throws TransformationFailedException if object (modele) is not found.
     */
    public function reverseTransform($modelelibelle)
    {
        // no issue number? It's optional, so that's ok
        if (!$modelelibelle) {
            return;
        }

        $modele = $this->entityManager
            ->getRepository(Modele::class)
            // query for the modele with this id
            ->findBy(array('libelle' => $modelelibelle))
        ;


        if (null === $modele) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $modelelibelle
            ));
        }

        return $modele[0];
    }
}
