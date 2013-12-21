<?php


class AutoloaderInit
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('AutoloaderInit', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('AutoloaderInit', 'loadClassLoader'));


	    $baseDir = dirname(dirname(dirname(__FILE__)));
	    $vendorDir  = $baseDir . '/vendor';

        $mapLibrary = require_once $baseDir . '/app/autoload/autoload_namespaces.php';
	    $mapVendor  = require_once $vendorDir .'/composer/autoload_namespaces.php';
	    $map = array_merge($mapLibrary, $mapVendor);
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $libraryClassMap = require_once $baseDir . '/app/autoload/autoload_classmap.php';
        $vendorClassMap  = require_once $vendorDir . '/composer/autoload_classmap.php';
	    $classMap = array_merge($libraryClassMap, $vendorClassMap);
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        return $loader;
    }
}
