<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration(array(
    __DIR__."/module"), $isDevMode);

//$config = Setup::createAnnotationMetadataConfiguration(
//    array(__DIR__."/module"), $isDevMode, null, null, false);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/module/Main/src/Main/Database/demo.db'
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);