<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb1a50d83876f3124dc1a013d1b01bd7e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb1a50d83876f3124dc1a013d1b01bd7e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb1a50d83876f3124dc1a013d1b01bd7e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb1a50d83876f3124dc1a013d1b01bd7e::$classMap;

        }, null, ClassLoader::class);
    }
}
