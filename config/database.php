<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$connParams = [
    'dbname' => 'workanasoft',
    'user' => 'postgres',
    'password' => 'postgres',
    'host' => 'db',
    'driver' => 'pdo_pgsql',
];

$isDevMode = true;
$paths = [__DIR__."/../src/domain/entities"];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

$entityManager = EntityManager::create($connParams, $config);
