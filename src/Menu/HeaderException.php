<?php

namespace Sbyaute\FrontBundle\Menu;

use Exception;
use Knp\Menu\MenuItem;

class HeaderException extends Exception
{
    public function __construct(MenuItem $menuItem)
    {
        $message = "Vous ne pouvez pas rattacher un header à l'élément `{$menuItem->getLabel()}` du menu. ";
        $message .= 'Un header ne peut pas être utilisé sur un élément parent ni un élément enfant.';

        parent::__construct($message);
    }
}
