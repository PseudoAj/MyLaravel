<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae77c210b855f42f9aa0e7ee20f18ecf
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyLaravel\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyLaravel\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae77c210b855f42f9aa0e7ee20f18ecf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae77c210b855f42f9aa0e7ee20f18ecf::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
