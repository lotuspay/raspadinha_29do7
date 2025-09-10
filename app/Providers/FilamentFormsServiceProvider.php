<?php

namespace App\Providers;

use Filament\Forms\Components\Component;
use Illuminate\Support\ServiceProvider;

class FilamentFormsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the form component
        Component::macro('filamentForm', function (string $name) {
            return "filament-forms::components.{$name}";
        });
    }
}
