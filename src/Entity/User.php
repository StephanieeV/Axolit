<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_de_naissance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Annonce", mappedBy="user", orphanRemoval=true)
     */
    private $annonces;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Annonce", inversedBy="favoris")
     */
    private $favoris;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Badge", mappedBy="users")
     */
    private $badges;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reparation", mappedBy="user")
     */
    private $reparations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompetencesUser", inversedBy="User")
     */
    private $competencesUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoProfil", mappedBy="user", orphanRemoval=true)
     */
    private $photoProfils;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Amis", mappedBy="AamisB")
     */
    private $amis;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->reparations = new ArrayCollection();
        $this->photoProfils = new ArrayCollection();
        $this->amis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->contains($annonce)) {
            $this->annonces->removeElement($annonce);
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Annonce $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
        }

        return $this;
    }

    public function removeFavori(Annonce $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
        }

        return $this;
    }

    /**
     * @return Collection|Badge[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
            $badge->addUser($this);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
            $badge->removeUser($this);
        }

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
            $reparation->setUser($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->contains($reparation)) {
            $this->reparations->removeElement($reparation);
            // set the owning side to null (unless already changed)
            if ($reparation->getUser() === $this) {
                $reparation->setUser(null);
            }
        }

        return $this;
    }

    public function getCompetencesUser(): ?CompetencesUser
    {
        return $this->competencesUser;
    }

    public function setCompetencesUser(?CompetencesUser $competencesUser): self
    {
        $this->competencesUser = $competencesUser;

        return $this;
    }

    /**
     * @return Collection|PhotoProfil[]
     */
    public function getPhotoProfils(): Collection
    {
        return $this->photoProfils;
    }

    public function addPhotoProfil(PhotoProfil $photoProfil): self
    {
        if (!$this->photoProfils->contains($photoProfil)) {
            $this->photoProfils[] = $photoProfil;
            $photoProfil->setUser($this);
        }

        return $this;
    }

    public function removePhotoProfil(PhotoProfil $photoProfil): self
    {
        if ($this->photoProfils->contains($photoProfil)) {
            $this->photoProfils->removeElement($photoProfil);
            // set the owning side to null (unless already changed)
            if ($photoProfil->getUser() === $this) {
                $photoProfil->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Amis[]
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(Amis $ami): self
    {
        if (!$this->amis->contains($ami)) {
            $this->amis[] = $ami;
            $ami->addAamisB($this);
        }

        return $this;
    }

    public function removeAmi(Amis $ami): self
    {
        if ($this->amis->contains($ami)) {
            $this->amis->removeElement($ami);
            $ami->removeAamisB($this);
        }

        return $this;
    }
}
