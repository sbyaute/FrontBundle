<?php

namespace Sbyaute\FrontBundle\Event;

use Sbyaute\FrontBundle\Model\UserInterface;

/**
 * Classe d'événements liés à l'utilisateur.
 */
class UserEvent
{
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user = null)
    {
        $this->user = $user;
    }

    public function setUser(UserInterface $user): UserEvent
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}
