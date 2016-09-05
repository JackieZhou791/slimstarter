<?php

function application_settings() {
    //detect project enviroment
    $devhosts = require __DIR__ . '/../src/devhosts.php';
    $hostname = gethostname();
    if(in_array($hostname, $devhosts)) {
        $settings = require __DIR__ . '/../src/settings_dev.php';
    } else {
        $settings = require __DIR__ . '/../src/settings_prod.php';
    }
    
    return $settings;
}
