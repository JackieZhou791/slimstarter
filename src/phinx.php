<?php
$s = require(__DIR__ . '/settings.php');
$database = $s['settings']['database']['default'];
return [
    'paths' => [
        'migrations' => 'migrations'
    ],
    'migration_base_class' => 'Joyrun\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => $database['driver'],
            'host' => $database['host'],
            'name' => $database['database'],
            'user' => $database['username'],
            'pass' => $database['password'],
            'port' => $database['port']
        ]
    ]
];