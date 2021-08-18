<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5768cfd8cdeac9b8b5d68cdcb14472ce
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'P' => 
        array (
            'PaymentPlugins\\WooFunnels\\Stripe\\' => 33,
            'PaymentPlugins\\CartFlows\\Stripe\\' => 32,
            'PaymentPlugins\\Blocks\\Stripe\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'PaymentPlugins\\WooFunnels\\Stripe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/woofunnels/src',
        ),
        'PaymentPlugins\\CartFlows\\Stripe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/cartflows/src',
        ),
        'PaymentPlugins\\Blocks\\Stripe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/blocks/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5768cfd8cdeac9b8b5d68cdcb14472ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5768cfd8cdeac9b8b5d68cdcb14472ce::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
