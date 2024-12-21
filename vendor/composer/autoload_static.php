<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit815a165e47cb86ee028e79860260452f
{
    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'JasperPHP' => 
            array (
                0 => __DIR__ . '/..' . '/cossou/jasperphp/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit815a165e47cb86ee028e79860260452f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit815a165e47cb86ee028e79860260452f::$classMap;

        }, null, ClassLoader::class);
    }
}
