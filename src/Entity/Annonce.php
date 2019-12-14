<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $texte_annonce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_date_publication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getTexteAnnonce(): ?string
    {
        return $this->texte_annonce;
    }

    public function setTexteAnnonce(string $texte_annonce): self
    {
        $this->texte_annonce = $texte_annonce;

        return $this;
    }

    public function getHeureDatePublication(): ?\DateTimeInterface
    {
        return $this->heure_date_publication;
    }

    public function setHeureDatePublication(\DateTimeInterface $heure_date_publication): self
    {
        $this->heure_date_publication = $heure_date_publication;

        return $this;
    }
}
