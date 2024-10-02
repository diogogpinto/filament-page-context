<?php

namespace DiogoGPinto\FilamentPageContext;

use DiogoGPinto\FilamentPageContext\Testing\TestsFilamentPageContext;
use Filament\FilamentManager;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPageContextServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-page-context';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name);
    }

    public function packageRegistered(): void
    {
        app()->extend('filament', closure: function ($filament, $app) {
            return new class extends FilamentManager
            {
                public function pageContext(): FilamentPageContext
                {
                    // Your getTheme logic here
                    return new FilamentPageContext;
                }
            };
        });
    }

    public function packageBooted(): void
    {
        // Testing
        Testable::mixin(new TestsFilamentPageContext);
    }
}
