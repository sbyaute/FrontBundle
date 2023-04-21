<?php

namespace Sbyaute\FrontBundle\Twig;

use Sbyaute\FrontBundle\Event\UserEvent;
use Sbyaute\FrontBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Classe, liée aux événements, permettant de créer des extensions twig (filtres/fonctions).
 */
class UserEventsExtension extends AbstractExtension
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('front_user', [$this, 'getUserDetails']),
        ];
    }

    public function getUserDetails(): ?UserInterface
    {
        if (!$this->eventDispatcher->hasListeners(UserEvent::class)) {
            return null;
        }

        /** @var UserEvent $userEvent */
        $userEvent = $this->eventDispatcher->dispatch(new UserEvent());

        if ($userEvent instanceof UserEvent && null !== $userEvent->getUser()) {
            return $userEvent->getUser();
        }

        return null;
    }
}
