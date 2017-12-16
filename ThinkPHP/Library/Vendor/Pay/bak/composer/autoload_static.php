<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit02ec002b492ca4c7b71e3b7321e877e6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pay\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pay\\' => 
        array (
            0 => __DIR__ . '/..' . '/zoujingli/pay-php-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit02ec002b492ca4c7b71e3b7321e877e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit02ec002b492ca4c7b71e3b7321e877e6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
