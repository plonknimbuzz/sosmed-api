<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7532f86290d86390a5f3e1e37c58eb14
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Curl\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Curl\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-curl-class/php-curl-class/src/Curl',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7532f86290d86390a5f3e1e37c58eb14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7532f86290d86390a5f3e1e37c58eb14::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}