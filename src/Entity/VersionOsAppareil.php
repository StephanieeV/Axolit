<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VersionOsAppareilRepository")
 */
class VersionOsAppareil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce", inversedBy="versionOsAppareils")
     */
    private $annonces;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAnnonces(): ?Annonce
    {
        return $this->annonces;
    }

    public function setAnnonces(?Annonce $annonces): self
    {
        $this->annonces = $annonces;

        return $this;
    }
}
