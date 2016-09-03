<?php
namespace Joyrun\Template;

use Twig_Environment;
class TwigRenderer implements Joyrun\Template\Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = [])
    {
        return $this->renderer->render("$template.html", $data);
    }
}