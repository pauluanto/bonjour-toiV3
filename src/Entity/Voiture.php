<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $anne_de_naissance;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur_yeux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur_cheveux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $citation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $livres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $films;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loisirs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue_parle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Jerecherche;

    /**
     * @ORM\Column(type="integer")
     */
    private $Taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $user_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }


    public function getAnnedenaissance(): ?int
    {
        return $this->anne_de_naissance;
    }

    public function setAnnedenaissance(int $anne_de_naissance): self
    {
        $this->anne_de_naissance = $anne_de_naissance;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCouleurYeux(): ?string
    {
        return $this->couleur_yeux;
    }

    public function setCouleurYeux(string $couleur_yeux): self
    {
        $this->couleur_yeux = $couleur_yeux;

        return $this;
    }

    public function getCouleurCheveux(): ?string
    {
        return $this->couleur_cheveux;
    }

    public function setCouleurCheveux(string $couleur_cheveux): self
    {
        $this->couleur_cheveux = $couleur_cheveux;

        return $this;
    }

    public function getCitation(): ?string
    {
        return $this->citation;
    }

    public function setCitation(?string $citation): self
    {
        $this->citation = $citation;

        return $this;
    }

    public function getLivres(): ?string
    {
        return $this->livres;
    }

    public function setLivres(?string $livres): self
    {
        $this->livres = $livres;

        return $this;
    }

    public function getFilms(): ?string
    {
        return $this->films;
    }

    public function setFilms(string $films): self
    {
        $this->films = $films;

        return $this;
    }

    public function getLoisirs(): ?string
    {
        return $this->loisirs;
    }

    public function setLoisirs(string $loisirs): self
    {
        $this->loisirs = $loisirs;

        return $this;
    }

    public function getLangueParle(): ?string
    {
        return $this->langue_parle;
    }

    public function setLangueParle(string $langue_parle): self
    {
        $this->langue_parle = $langue_parle;

        return $this;
    }

    public function getJerecherche(): ?string
    {
        return $this->Jerecherche;
    }

    public function setJerecherche(string $Jerecherche): self
    {
        $this->Jerecherche = $Jerecherche;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->Taille;
    }

    public function setTaille(int $Taille): self
    {
        $this->Taille = $Taille;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe($sexe): void
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }



}
