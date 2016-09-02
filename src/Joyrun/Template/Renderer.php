<?php
namespace JoyRun\Template;

interface Renderer
{
    public function render($template, $data = []);
}
