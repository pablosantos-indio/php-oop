<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;

class Controller
{
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->init();
    }

    private function init(): void
    {
        $this->loader = new FilesystemLoader(VIEWS_PATH);
        $this->twig = new Environment($this->loader, [
            'cache' => APP_ROOT . '/twig_cache',
            'auto_reload' => true,
        ]);
        $this->addGlobalFunctions();
    }

    /**
     * @param string @layout
     * @param array @data
     */
    public function render(string $layout, array $data = []): void
    {
        $twig = $this->twig;

        $data = array_merge(
            $data,
            [
                'controller' => $this,
                'session' => $_SESSION,
            ]
        );

        echo $twig->render(
            "Layouts/$layout",
            $data,
        );
    }

    /**
     * register global functions to twig
     */
    protected function addGlobalFunctions(): void
    {
        $functions = [
            'getSessionMessage',
            'getErrorMessage',
            'getField',
            'isUserLoggedIn',
        ];

        foreach ($functions as $function) {
            $this->twig->addFunction(new TwigFunction($function, $function));
            // if(function_exists($function)) {
            //     $this->twig->addFunction(new TwigFunction($function, $function));
            // }
        }
    }
}
