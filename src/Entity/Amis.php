<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AmisRepository")
 */
class Amis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="amis")
     */
    private $AamisB;

    public function __construct()
    {
        $this->AamisB = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getAamisB(): Collection
    {
        return $this->AamisB;
    }

    public function addAamisB(User $aamisB): self
    {
        if (!$this->AamisB->contains($aamisB)) {
            $this->AamisB[] = $aamisB;
        }

        return $this;
    }

    public function removeAamisB(User $aamisB): self
    {
        if ($this->AamisB->contains($aamisB)) {
            $this->AamisB->removeElement($aamisB);
        }

        return $this;
    }
}
