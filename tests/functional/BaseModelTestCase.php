<?php

namespace Tests\Functional;

use Slim\App;

class BaseModelTestCase extends  \PHPUnit_Framework_TestCase
{
    public function initApp()
    {
        // Use the application settings
        //detect project enviroment
        $devhosts = require __DIR__ . '/../../src/devhosts.php';
        $hostname = gethostname();
        if(in_array($hostname, $devhosts)) {
            $settings = require __DIR__ . '/../../src/settings_dev.php';
        } else {
            $settings = require __DIR__ . '/../../src/settings_prod.php';
        }

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';


    }
}