<?php

namespace Tests\Functional;

use Slim\App;

class BaseModelTestCase extends  \PHPUnit_Framework_TestCase
{
    public function initApp()
    {
        // Use the application settings
        $settings = require __DIR__ . '/../../src/settings.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';


    }
}