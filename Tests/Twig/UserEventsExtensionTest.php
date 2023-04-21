<?php

namespace Sbyaute\FrontBundle\Tests\Twig;

use Sbyaute\FrontBundle\Twig\UserEventsExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserEventsExtensionTest extends TestCase
{
    public function testGetFunctions()
    {
        $dispatcher = $this->createMock(EventDispatcherInterface::class);

        $event = new UserEventsExtension($dispatcher);
        $this->assertCount(1, $event->getFunctions(), "Le 'getFunctions()' doit contenir 1 élément");
        $this->assertEquals('front_user', ($event->getFunctions()[0])->getName(), "Le premier élément de 'getFunctions()' doit renvoyer 'front_user'");
    }
}
