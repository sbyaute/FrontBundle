<?php

namespace Sbyaute\FrontBundle\Menu;

use Exception;
use Knp\Menu\MenuItem;

class MissingIconException extends Exception
{
    public function __construct(MenuItem $menuItem)
    {
        $message = 'Vous devez associer une icône à l\'élément '.$menuItem->getName().' du menu. ';
        $message .= 'Utilisez la méthode MenuItem::setLabelAttribute(). Ex: setLabelAttribute(\'icon\', \'bi-bootstrap\');';

        parent::__construct($message);
    }
}
