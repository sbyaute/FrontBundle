<?php

namespace Sbyaute\FrontBundle\Model;

/**
 * Classe proposant un modèle d'utilisateur.
 */
class UserModel implements UserInterface
{
    /**
     * Prénom de l’utilisateur Ex : Pascal.
     *
     * @var string
     */
    protected $prenom;

    /**
     * Nom de famille de l’utilisateur Ex : DUPONT.
     *
     * @var string
     */
    protected $nom;

    /**
     * Rôles de l'utilisateur  Ex : ROLE_USER.
     *
     * @var array
     */
    protected $roles;

    public function __construct(string $prenom = '', string $nom = '', array $roles = [])
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->roles = $roles;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
