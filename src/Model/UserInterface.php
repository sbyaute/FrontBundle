<?php

namespace Sbyaute\FrontBundle\Model;

interface UserInterface
{
    /**
     * @return string
     */
    public function getPrenom();

    /**
     * @return string
     */
    public function getNom();

    /**
     * @return array
     */
    public function getRoles();
}
