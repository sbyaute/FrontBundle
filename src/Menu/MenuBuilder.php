<?php

namespace Sbyaute\FrontBundle\Menu;

use Sbyaute\FrontBundle\Event\KnpMenuEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var LogoutUrlGenerator
     */
    private $logoutUrlGenerator;

    /**
     * @var bool
     */
    private $logout;

    /**
     * @var bool
     */
    private $externalLink;

    public const MENU_CLASS = 'metismenu';
    public const EXTERNAL_LINK_CLASS = 'menu-external-link';
    public const LOGOUT_ICON = 'bi-box-arrow-left';

    public function __construct(
        FactoryInterface $factory,
        EventDispatcherInterface $eventDispatcher,
        Security $security,
        LogoutUrlGenerator $logoutUrlGenerator,
        bool $logout,
        bool $externalLink
    ) {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
        $this->security = $security;
        $this->logoutUrlGenerator = $logoutUrlGenerator;
        $this->logout = $logout;
        $this->externalLink = $externalLink;
    }

    public function createMainMenu(array $options): MenuItem
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => self::MENU_CLASS.($this->externalLink ? ' '.self::EXTERNAL_LINK_CLASS : ''),
            ],
        ]);
        $this->eventDispatcher->dispatch(new KnpMenuEvent($menu, $this->factory, $options));

        // Ajoute un lien de déconnexion si
        // - la configuration du bundle l'exige
        // - l'utilisateur est authentifié
        // - une route de déconnexion est associée au firewall
        if ($this->logout && $this->security->getUser()) {
            $logoutPath = $this->logoutUrlGenerator->getLogoutPath();
            if ($logoutPath) {
                $menu
                    ->addChild('Déconnexion', [
                        'label' => 'Déconnexion',
                    ])
                    ->setLabelAttribute('icon', self::LOGOUT_ICON)
                    ->setUri($logoutPath)
                ;
            }
        }

        $this->lintMenuItem($menu);

        return $menu;
    }

    /**
     * @throws HeaderException
     * @throws MissingIconException
     */
    private function lintMenuItem(MenuItem $menuItem): void
    {
        // Ignore la racine du menu (élément sans parent)
        if (null !== $menuItem->getParent()) {
            $this->checkMenuIcons($menuItem);
            $this->checkMenuHeaders($menuItem);
        }

        foreach ($menuItem->getChildren() as $children) {
            $this->lintMenuItem($children);
        }
    }

    /**
     * @throws MissingIconException S'il manque une icône sur un élément du menu
     */
    private function checkMenuIcons(MenuItem $menuItem): void
    {
        $labelAttributes = $menuItem->getLabelAttributes();
        if (empty($labelAttributes['icon']) && !in_array('header', $menuItem->getAttributes())) {
            throw new MissingIconException($menuItem);
        }
    }

    /**
     * @throws HeaderException Si un header est défini en tant que parent ou enfant
     */
    private function checkMenuHeaders(MenuItem $menuItem): void
    {
        // Test la possibilité d'ajouter un header.
        if (in_array('header', $menuItem->getAttributes())) {
            // Lève une exception si l'item possède des enfants ou s'il est lui même un enfant (hors élément racine)
            if ($menuItem->hasChildren() || !$menuItem->getParent()->isRoot()) {
                throw new HeaderException($menuItem);
            }
        }
    }
}
