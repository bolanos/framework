<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

//print_r(__DIR__ . '/autoload');

$baseDir    = dirname(__FILE__);
$libraryDir = $baseDir . '/library';

require_once 'autoload/autoload_real.php';

$loader = AutoloaderInit::getLoader();

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;