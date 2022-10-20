<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit980d56f7058347470686543f02a821a6
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ScssPhp\\ScssPhp\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ScssPhp\\ScssPhp\\' => 
        array (
            0 => __DIR__ . '/..' . '/scssphp/scssphp/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit980d56f7058347470686543f02a821a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit980d56f7058347470686543f02a821a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit980d56f7058347470686543f02a821a6::$classMap;

        }, null, ClassLoader::class);
    }
}
