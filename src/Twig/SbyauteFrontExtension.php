<?php

namespace Sbyaute\FrontBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SbyauteFrontExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'generate_delete_button',
                [DeleteButtonGeneratorRuntime::class, 'generate'],
                ['is_safe' => ['html']]
            ),
            new TwigFunction(
                'generate_delete_modal',
                [DeleteModalGeneratorRuntime::class, 'generate'],
                ['is_safe' => ['html']]
            ),
        ];
    }
}
