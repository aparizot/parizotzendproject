<?php

use Doctrine\DBAL\Driver\PDOMySql\Driver;

return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host'     => $_ENV['SKEL_DB_HOST'] ?? 'localhost',
                    'port'     => $_ENV['SKEL_DB_PORT'] ?? '3306',
                    'user'     => $_ENV['SKEL_DB_USER'] ?? 'root',
                    'password' => $_ENV['SKEL_DB_PASS'] ?? '',
                    'dbname'   => $_ENV['SKEL_DB_NAME'] ?? 'zend3_meetup_database',
                ],
            ],
        ],
    ],
];
