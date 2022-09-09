<?php

namespace lockscreen\FilamentLockscreen;

use Filament\PluginServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Router;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use Spatie\LaravelPackageTools\Package;

class FilamentLockscreenServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-lockscreen')
            ->hasConfigFile()
            ->hasRoute('web')
            ;
    }

    /**
     * @throws BindingResolutionException
     */
    public function packageBooted()
    {
        parent::packageBooted();
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', Locker::class);
    }


}
