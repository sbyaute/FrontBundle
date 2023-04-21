<?php

namespace Sbyaute\FrontBundle\Tests\Model;

use Sbyaute\FrontBundle\Model\UserModel;
use PHPUnit\Framework\TestCase;
use TypeError;

class UserModelTest extends TestCase
{
    /**
     * @dataProvider providerEverything
     */
    public function testEverythingOK($prenom, $nom, $roles): void
    {
        $user = new UserModel($prenom, $nom, $roles);

        $this->assertEquals($prenom, $user->getPrenom(), "Le prénom doit renvoyer $prenom");
        $this->assertEquals($nom, $user->getNom(), "Le nom doit renvoyer $nom");
        $this->assertEquals($roles, $user->getRoles(), 'Les rôles doivent renvoyer '.empty($roles) ? '[]' : "['ROLE_USER']");
    }

    public static function providerEverything()
    {
        return [
            ['Pascal', 'DUPONT', ['ROLE_USER']],
            ['Pascal', '', []],
            ['', '', []],
        ];
    }

    /**
     * @dataProvider providerExceptions
     */
    public function testExceptions($object, $value, $typeError, $attribut = null): void
    {
        $this->expectException($typeError);
        $object->setPrenom($value);
        $object->setRoles($value);
    }

    public static function providerExceptions()
    {
        return [
            [new UserModel(), null, TypeError::class],
            [new UserModel(), [], TypeError::class],
            [new UserModel(), 'foo', TypeError::class],
        ];
    }
}
