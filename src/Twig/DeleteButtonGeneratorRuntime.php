<?php

namespace Sbyaute\FrontBundle\Twig;

use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class DeleteButtonGeneratorRuntime implements RuntimeExtensionInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * DeleteButtonGeneratorRuntime constructor.
     */
    public function __construct(
        Environment $twig
    ) {
        $this->twig = $twig;
    }

    /**
     * Generate delete button.
     *
     * @param string $name        logic name for templating
     * @param string $identifiant entity id to delete
     */
    public function generate(string $name, string $identifiant): string
    {
        return $this->twig->render(
            '@Front/delete-modal/delete_button.html.twig',
            [
                'name' => $name,
                'id' => $identifiant,
            ]
        );
    }
}
