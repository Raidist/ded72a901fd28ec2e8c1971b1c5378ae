<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita9b321296fbd05cfcdb3bd99c165bc38
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'O' => 
        array (
            'OAuth2' => 
            array (
                0 => __DIR__ . '/..' . '/bshaffer/oauth2-server-php/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita9b321296fbd05cfcdb3bd99c165bc38::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita9b321296fbd05cfcdb3bd99c165bc38::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInita9b321296fbd05cfcdb3bd99c165bc38::$prefixesPsr0;
            $loader->classMap = ComposerStaticInita9b321296fbd05cfcdb3bd99c165bc38::$classMap;

        }, null, ClassLoader::class);
    }
}
