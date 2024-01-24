<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

// Parâmetros de conexão com o banco de dados
$connParams = [
    'dbname' => 'workanasoft',
    'user' => 'postgres',
    'password' => 'postgres',
    'host' => 'localhost',
    'driver' => 'pdo_pgsql',
];

$isDevMode = true;
$paths = [__DIR__."/../src/domain/entities"];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

$entityManager = EntityManager::create($connParams, $config);
