<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=4096)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit faire minimum 6 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe doit être identique")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $ddn;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Badge", inversedBy="users")
     */
    private $badges;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Annonce", inversedBy="users")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reparation", mappedBy="user")
     */
    private $reparation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Annonce", mappedBy="user")
     */
    private $annonces;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoprofil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompetenceUser", mappedBy="user", orphanRemoval=true)
     */
    private $competences;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->reparation = new ArrayCollection();

        $this->photoProfils = new ArrayCollection();
        $this->annonces = new ArrayCollection();
        $this->competences = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

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

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
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

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(?string $Ville): self
    {
        $this->Ville = $Ville;

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

    public function getDdn(): ?\DateTimeInterface
    {
        return $this->ddn;
    }

    public function setDdn(?\DateTimeInterface $ddn): self
    {
        $this->ddn = $ddn;

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
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
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
     * @return Collection|Reparation[]
     */
    public function getReparation(): Collection
    {
        return $this->reparation;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparation->contains($reparation)) {
            $this->reparation[] = $reparation;
            $reparation->setUser($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparation->contains($reparation)) {
            $this->reparation->removeElement($reparation);
            // set the owning side to null (unless already changed)
            if ($reparation->getUser() === $this) {
                $reparation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PhotoProfil[]
     */
    public function getPhotoProfils(): Collection
    {
        return $this->photoProfils;
        //return "/public/pddp.jpg";
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

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getPhotoprofil(): ?string
    {
        if(isset($this->photoprofil) && $this->photoprofil != ""){
        return '/img/profil/'.$this->photoprofil;
        }
        else{
            return '/img/profil/photo_profil.jpg';
        }
    }

    public function setPhotoprofil(?string $photoprofil): self
    {
        $this->photoprofil = $photoprofil;

        return $this;
    }

    /**
     * @return Collection|CompetenceUser[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(CompetenceUser $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setUser($this);
        }

        return $this;
    }

    public function removeCompetence(CompetenceUser $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
            // set the owning side to null (unless already changed)
            if ($competence->getUser() === $this) {
                $competence->setUser(null);
            }
        }

        return $this;
    }

}
