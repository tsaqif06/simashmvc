<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit35f5a20a93c0515b9d8ac34e9ea3002e
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tsaqif06\\Simashmvc\\' => 19,
        ),
        'M' => 
        array (
            'Modules\\' => 8,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'E' => 
        array (
            'Envms\\FluentPDO\\' => 16,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tsaqif06\\Simashmvc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/modules',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Envms\\FluentPDO\\' => 
        array (
            0 => __DIR__ . '/..' . '/envms/fluentpdo/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit35f5a20a93c0515b9d8ac34e9ea3002e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit35f5a20a93c0515b9d8ac34e9ea3002e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit35f5a20a93c0515b9d8ac34e9ea3002e::$classMap;

        }, null, ClassLoader::class);
    }
}
