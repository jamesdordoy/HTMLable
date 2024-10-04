<?php

namespace JamesDordoy\HTMLable;

use Illuminate\Support\Facades\Route;
use JamesDordoy\HTMLable\Models\Document;
use JamesDordoy\HTMLable\Models\Element;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HTMLableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        //https://github.com/spatie/laravel-package-tools
        $package
            ->name('htmlable')
            ->hasConfigFile()
            ->hasMigration('2024_10_05_create_htmlable_documents_table')
            ->hasMigration('2024_10_05_create_htmlable_elements_table')
            ->hasMigration('2024_10_05_create_htmlable_values_table')
            ->runsMigrations();
    }

    public function boot()
    {
        parent::boot();

        Route::model('document', Document::class);
        Route::model('element', Element::class);
    }
}
