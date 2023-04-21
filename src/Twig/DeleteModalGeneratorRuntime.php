<?php

namespace Sbyaute\FrontBundle\Twig;

use Sbyaute\FrontBundle\Form\DeleteForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class DeleteModalGeneratorRuntime implements RuntimeExtensionInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * DeleteButtonGeneratorRuntime constructor.
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Generate delete form.
     *
     * @param string $name  logic name for appearing with button
     * @param string $route $route to redirect
     */
    public function generate(string $name, string $route): string
    {
        $deleteForm = $this
            ->formFactory
            ->createNamed(
                "delete_form_{$name}",
                DeleteForm::class,
                [],
                [
                    'action' => $this->urlGenerator->generate($route),
                ]
            );

        return $this->twig->render(
            '@Front/delete-modal/delete_modal.html.twig',
            [
                'name' => $name,
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }
}
