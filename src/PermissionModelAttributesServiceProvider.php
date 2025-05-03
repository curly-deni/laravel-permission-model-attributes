<?php

namespace Aesis\PermissionModelAttributes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Aesis\PermissionModelAttributes\Commands\PermissionModelAttributesCommand;

class PermissionModelAttributesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-permission-model-attributes')
            ->hasConfigFile();
    }
}
