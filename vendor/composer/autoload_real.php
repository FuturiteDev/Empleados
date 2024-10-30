<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit50578d3309f40d512b817e4544e5a85b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit50578d3309f40d512b817e4544e5a85b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit50578d3309f40d512b817e4544e5a85b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit50578d3309f40d512b817e4544e5a85b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
