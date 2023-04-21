<?php

namespace Sbyaute\FrontBundle\Twig;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GetParameterExtension extends AbstractExtension
{
    protected $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getParameter($parameter)
    {
        if ($this->parameterBag->has($parameter)) {
            return $this->parameterBag->get($parameter);
        }
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_parameter', [$this, 'getParameter']),
        ];
    }
}
