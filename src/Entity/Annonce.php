<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="favoris")
     */
    private $favoris;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modele;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoAnnonce", mappedBy="annonce", orphanRemoval=true)
     */
    private $photoAnnonces;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VersionOsAppareil", mappedBy="annonces")
     */
    private $versionOsAppareils;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAnnonce", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_annonce;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAppareil", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_appareil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reparation", mappedBy="annonce")
     */
    private $reparations;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->photoAnnonces = new ArrayCollection();
        $this->versionOsAppareils = new ArrayCollection();
        $this->reparations = new ArrayCollection();
    }

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
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(User $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addFavori($this);
        }

        return $this;
    }

    public function removeFavori(User $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeFavori($this);
        }

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|PhotoAnnonce[]
     */
    public function getPhotoAnnonces(): Collection
    {
        return $this->photoAnnonces;
    }

    public function addPhotoAnnonce(PhotoAnnonce $photoAnnonce): self
    {
        if (!$this->photoAnnonces->contains($photoAnnonce)) {
            $this->photoAnnonces[] = $photoAnnonce;
            $photoAnnonce->setAnnonce($this);
        }

        return $this;
    }

    public function removePhotoAnnonce(PhotoAnnonce $photoAnnonce): self
    {
        if ($this->photoAnnonces->contains($photoAnnonce)) {
            $this->photoAnnonces->removeElement($photoAnnonce);
            // set the owning side to null (unless already changed)
            if ($photoAnnonce->getAnnonce() === $this) {
                $photoAnnonce->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection|VersionOsAppareil[]
     */
    public function getVersionOsAppareils(): Collection
    {
        return $this->versionOsAppareils;
    }

    public function addVersionOsAppareil(VersionOsAppareil $versionOsAppareil): self
    {
        if (!$this->versionOsAppareils->contains($versionOsAppareil)) {
            $this->versionOsAppareils[] = $versionOsAppareil;
            $versionOsAppareil->setAnnonces($this);
        }

        return $this;
    }

    public function removeVersionOsAppareil(VersionOsAppareil $versionOsAppareil): self
    {
        if ($this->versionOsAppareils->contains($versionOsAppareil)) {
            $this->versionOsAppareils->removeElement($versionOsAppareil);
            // set the owning side to null (unless already changed)
            if ($versionOsAppareil->getAnnonces() === $this) {
                $versionOsAppareil->setAnnonces(null);
            }
        }

        return $this;
    }

    public function getTypeAnnonce(): ?TypeAnnonce
    {
        return $this->type_annonce;
    }

    public function setTypeAnnonce(?TypeAnnonce $type_annonce): self
    {
        $this->type_annonce = $type_annonce;

        return $this;
    }

    public function getTypeAppareil(): ?TypeAppareil
    {
        return $this->type_appareil;
    }

    public function setTypeAppareil(?TypeAppareil $type_appareil): self
    {
        $this->type_appareil = $type_appareil;

        return $this;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations[] = $reparation;
            $reparation->setAnnonce($this);
        }

        return $this;
    }
}