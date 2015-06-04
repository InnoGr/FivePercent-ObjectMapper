<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$vendorDir = __DIR__ . '/../../..';

/** @var \Composer\Autoload\ClassLoader $loader */

if (file_exists($file = $vendorDir . '/autoload.php')) {
    $loader = require_once $file;
} else if (file_exists($file = './vendor/autoload.php')) {
    $loader = require_once $file;
} else {
    throw new \RuntimeException("Not found composer autoload");
}

// Register loader for annotation registry
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

// Add PSR-4 prefix
$loader->addPsr4('FivePercent\\Component\\ObjectMapper\\Tests\\', __DIR__);
