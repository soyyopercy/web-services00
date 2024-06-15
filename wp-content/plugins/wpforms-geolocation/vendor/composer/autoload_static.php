<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2af4df59c78d6da695a2c36135d0abde
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPFormsGeolocation\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPFormsGeolocation\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2af4df59c78d6da695a2c36135d0abde::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2af4df59c78d6da695a2c36135d0abde::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2af4df59c78d6da695a2c36135d0abde::$classMap;

        }, null, ClassLoader::class);
    }
}