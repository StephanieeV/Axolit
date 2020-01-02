<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReparationRepository")
 */
class Reparation
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
    private $note;

    /**
     * @ORM\Column(type="text")
     */
    private $titre_commmentaire;

    /**
     * @ORM\Column(type="text")
     */
    private $texte_commentaire;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce", inversedBy="reparations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reparation")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTitreCommmentaire(): ?string
    {
        return $this->titre_commmentaire;
    }

    public function setTitreCommmentaire(string $titre_commmentaire): self
    {
        $this->titre_commmentaire = $titre_commmentaire;

        return $this;
    }

    public function getTexteCommentaire(): ?string
    {
        return $this->texte_commentaire;
    }

    public function setTexteCommentaire(string $texte_commentaire): self
    {
        $this->texte_commentaire = $texte_commentaire;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
