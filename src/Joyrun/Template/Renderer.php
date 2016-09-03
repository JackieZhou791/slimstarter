<?php
namespace Joyrun\Template;

interface Renderer
{
    public function render($template, $data = []);
}
