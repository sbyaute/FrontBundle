<?php

namespace Sbyaute\FrontBundle\Tests\Event;

use Sbyaute\FrontBundle\Event\UserEvent;
use Sbyaute\FrontBundle\Model\UserInterface;
use Sbyaute\FrontBundle\Model\UserModel;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    public function testUserNull(): void
    {
        $event = new UserEvent();
        $this->assertNull($event->getUser(), "Le 'getUser()' doit renvoyer null");
    }

    public function testUserNotNull(): void
    {
        $event = new UserEvent();
        $event->setUser(new UserModel());
        $this->assertInstanceOf(UserInterface::class, $event->getUser(), "Le 'getUser()' doit renvoyer une instance de type 'UserInterface'");
        $this->assertNotNull($event->getUser(), "Le 'getUser()' doit renvoyer un objet");
    }
}
