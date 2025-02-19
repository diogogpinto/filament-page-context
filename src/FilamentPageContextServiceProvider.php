<?php

namespace DiogoGPinto\FilamentPageContext;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPageContextServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-page-context';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }

    public function packageRegistered(): void
    {
        app()->extend('filament', function ($filament, $app) {
            return new CustomFilamentManager($app);
        });
    }
}
