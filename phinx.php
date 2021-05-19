<?php
$pdo = require __DIR__."/config/create-db-pdo-connection.php";
return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'name' => $dbName,
            'connection' => $pdo
        ]
    ],
    'version_order' => 'creation'
];
