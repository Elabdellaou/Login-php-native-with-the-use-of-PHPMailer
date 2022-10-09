<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit43bd48e149d376216d84a5d365138b69
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit43bd48e149d376216d84a5d365138b69', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit43bd48e149d376216d84a5d365138b69', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit43bd48e149d376216d84a5d365138b69::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
