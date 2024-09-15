<?php

namespace App\Providers;

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (!Type::hasType('timestamp')) {
            Type::addType('timestamp', 'Doctrine\DBAL\Types\StringType');
            $platform = \DB::getDoctrineConnection()->getDatabasePlatform();
            $platform->markDoctrineTypeCommented(Type::getType('timestamp'));
        }
    }
}
