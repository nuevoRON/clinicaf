<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita509aa7bad1eab6873e420350fdbcf7e
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInita509aa7bad1eab6873e420350fdbcf7e::$classMap;

        }, null, ClassLoader::class);
    }
}
