<?php



class ComposerAutoloaderInit5c2d55f2c6a1beb7d2e6f86db6617efc
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

        spl_autoload_register(array('ComposerAutoloaderInit5c2d55f2c6a1beb7d2e6f86db6617efc', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5c2d55f2c6a1beb7d2e6f86db6617efc', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5c2d55f2c6a1beb7d2e6f86db6617efc::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
