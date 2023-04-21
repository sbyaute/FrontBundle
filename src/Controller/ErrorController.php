<?php

namespace Sbyaute\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Throwable;
use Twig\Environment;

class ErrorController extends AbstractController
{
    private $errorRenderer;
    private $loader;

    public function __construct(ErrorRendererInterface $errorRenderer, Environment $twig)
    {
        $this->errorRenderer = $errorRenderer;
        $this->loader = $twig->getLoader();
    }

    public function showProd(Request $request, Throwable $exception, ?DebugLoggerInterface $logger): Response
    {
        return $this->renderResponse($exception);
    }

    public function show(Request $request, Throwable $exception, ?DebugLoggerInterface $logger): Response
    {
        if (HttpException::class === get_class($exception)) {
            // On identifie le mode preview par la présence d'une exception générique HttpException
            return $this->renderResponse($exception);
        }
        // Affichage détaillé pris en charge par Symfony
        $exception = $this->errorRenderer->render($exception);

        return new Response($exception->getAsString(), $exception->getStatusCode(), $exception->getHeaders());
    }

    protected function renderResponse(Throwable $exception): Response
    {
        // Rendu des erreurs avec les templates du bundle
        $templatePrefix = '@Front/Exception/error';
        $template = '.html.twig';
        if (
            $exception instanceof HttpException
            && $this->loader->exists($templatePrefix.$exception->getStatusCode().$template)
        ) {
            return $this->render($templatePrefix.$exception->getStatusCode().$template);
        }

        return $this->render($templatePrefix.$template);
    }
}
