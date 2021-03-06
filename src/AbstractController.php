<?php

namespace Comito;

use Comito\FlashBag;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    private $templateEngine;

    private $flashbag;

    public function __construct() 
    {
        $loader = new FilesystemLoader(ROOT_DIR . '/templates');
        $this->templateEngine = new Environment($loader);
        $this->flashbag = new FlashBag();
    }

    /**
     * Getter pour flashBag
     */
    protected function flash()
    {
        return $this->flashbag;
    }

    protected function render($view, $vars = [])
    {
        return $this->templateEngine->render(
            $view.'.html.twig', 
            array_merge($vars, ['current_page' => $_SERVER["PATH_INFO"]??'/'])
        );
    }

    protected function redirectToRoute($url)
    {
        header('location:'.$url);
        exit();
    }
}
