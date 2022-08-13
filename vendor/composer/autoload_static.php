<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit030e1aa71573054ad0696cca7f4eca09
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Imankubbil\\TraceTracking\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Imankubbil\\TraceTracking\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit030e1aa71573054ad0696cca7f4eca09::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit030e1aa71573054ad0696cca7f4eca09::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit030e1aa71573054ad0696cca7f4eca09::$classMap;

        }, null, ClassLoader::class);
    }
}
