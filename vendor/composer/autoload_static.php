<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita6e0873bcddcfb61ac77d31a4b740c69
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
        ),
        'P' => 
        array (
            'PhpOption\\' => 10,
        ),
        'M' => 
        array (
            'Model\\' => 6,
        ),
        'G' => 
        array (
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'E' => 
        array (
            'Entity\\' => 7,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controller\\' => 11,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/model',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Entity\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/entity',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/core',
        ),
        'Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/controller',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/app',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita6e0873bcddcfb61ac77d31a4b740c69::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita6e0873bcddcfb61ac77d31a4b740c69::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita6e0873bcddcfb61ac77d31a4b740c69::$classMap;

        }, null, ClassLoader::class);
    }
}
