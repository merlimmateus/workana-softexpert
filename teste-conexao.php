<?php
// Substitua pelo caminho correto para o autoload do Composer
global $entityManager;

require_once 'vendor/autoload.php';
require_once 'config/database.php';

try {
    $connection = $entityManager->getConnection();

    $connection->connect();

    if ($connection->isConnected()) {
        echo "Conexão com o banco de dados estabelecida com sucesso!";
    } else {
        echo "Falha ao conectar com o banco de dados.";
    }
} catch (Exception $e) {

    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}