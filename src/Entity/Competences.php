<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetencesRepository")
 */
class Competences
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
    private $libelle;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompetenceUser", mappedBy="competence", orphanRemoval=true)
     */
    private $competenceUsers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompetenceUser", inversedBy="competence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competenceUser;

    public function __construct()
    {
        $this->competenceUsers = new ArrayCollection();
    }

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



    /**
     * @return Collection|CompetenceUser[]
     */
    public function getCompetenceUsers(): Collection
    {
        return $this->competenceUsers;
    }

    public function addCompetenceUser(CompetenceUser $competenceUser): self
    {
        if (!$this->competenceUsers->contains($competenceUser)) {
            $this->competenceUsers[] = $competenceUser;
            $competenceUser->setCompetence($this);
        }

        return $this;
    }

    public function removeCompetenceUser(CompetenceUser $competenceUser): self
    {
        if ($this->competenceUsers->contains($competenceUser)) {
            $this->competenceUsers->removeElement($competenceUser);
            // set the owning side to null (unless already changed)
            if ($competenceUser->getCompetence() === $this) {
                $competenceUser->setCompetence(null);
            }
        }

        return $this;
    }


}
