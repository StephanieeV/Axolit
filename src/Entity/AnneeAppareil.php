<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnneeAppareilRepository")
 */
class AnneeAppareil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $couleur_appareil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCouleurAppareil(): ?string
    {
        return $this->couleur_appareil;
    }

    public function setCouleurAppareil(string $couleur_appareil): self
    {
        $this->couleur_appareil = $couleur_appareil;

        return $this;
    }
}
