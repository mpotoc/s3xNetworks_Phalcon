<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
        'Adverts\Models' => $config->application->modelsDir,
        'Adverts\Controllers' => $config->application->controllersDir,
        'Adverts\Forms' => $config->application->formsDir,
        'Adverts' => $config->application->libraryDir
    )
);

$loader->register();

// Use composer autoloader to load vendor classes
require_once __DIR__ . '/../../vendor/autoload.php';