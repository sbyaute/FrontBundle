<?php

namespace Sbyaute\FrontBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Collect all MenuItemInterface objects that should be rendered in the menu/navigation section.
 */
class KnpMenuEvent extends Event
{
    /**
     * @var ItemInterface
     */
    protected $menu;
    /**
     * @var FactoryInterface
     */
    protected $factory;
    /**
     * @var array
     */
    private $options;

    public function __construct(ItemInterface $menu, FactoryInterface $factory, array $options = [])
    {
        $this->menu = $menu;
        $this->factory = $factory;
        $this->options = $options;
    }

    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }

    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
