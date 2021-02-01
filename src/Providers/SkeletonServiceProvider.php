<?php

namespace MacsiDigital\Skeleton\Providers;

use Illuminate\Support\ServiceProvider;
use MacsiDigital\Skeleton\Http\Middleware\SkeletonMiddleware;
use MacsiDigital\Skeleton\Commands\SkeletonCommand;
use Illuminate\Filesystem\Filesystem;
use MacsiDigital\Skeleton\Package;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class SkeletonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadPublishable()
             ->loadFactories()
             ->loadCommands()
             ->loadViews()
             ->loadRoutes();
    }

    public function register(): void
    {
        $this->mergeConfigs()
            ->registerModelBindings()
            ->registerMacroHelpers()
            ->registerBladeDirectives()
            ->registerMiddleware()
            ->registerBladeComponents();
    }

    public function mergeConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/skeleton.php', 'skeleton');
        return $this;
    }

    protected function registerModelBindings(): self
    {
        $this->app->bind('skeleton.package', Package::class);
        return $this;
    }

    protected function registerMacroHelpers(): self
    {
        Route::macro('skeleton', function ($roles = []) {

        });
        return $this;
    }

    protected function registerBladeDirectives(): self
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('skeleton', function ($arguments) {

                return "<?php if(auth('web')->check()): ?>";
            });
        });
        return $this;
    }

    protected function registerMiddleware(): self
    {
        $this->app['router']->aliasMiddleware('skeleton', SkeletonMiddleware::class);
        return $this;
    }

    protected function registerBladeComponents(): self
    {
        Blade::component('skeleton', SkeletonComponent::class);
        // Blade::component('skeleton', 'skeleton.default');
        return $this;
    }


    public function loadPublishable(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/skeleton.php' => config_path('skeleton.php'),
            ], 'skeleton-config');

            $this->publishes([
                __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/skeleton'),
            ], 'skeleton-views');

//            if (!class_exists('CreatePackageTables')) {
//                $this->publishes([
//                    __DIR__ . '/../../database/migrations/create_skeleton_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_skeleton_tables.php'),
//                ], 'skeleton-migrations');
//            }

            $this->publishes($this->getNewMigrations(), 'skeleton-migrations');

            $this->loadCommands();
        }
        return $this;
    }

    public function loadFactories(): self
    {
        $this->loadFactoriesFrom(__DIR__.'/../../database/factories');
        return $this;
    }

    public function loadCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SkeletonCommand::class,
            ]);
        }
        return $this;
    }

    public function loadViews(): self
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'skeleton');
        return $this;
    }

    public function loadRoutes(): self
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        return $this;
    }

    protected function getNewMigrations(): array
    {
        $global_migrations = collect((new Filesystem)->files(database_path('/migrations')));

        $migrations = [];
        foreach ((new Filesystem)->files(__DIR__.'/../../database/migrations') as $migration) {
            if (! $global_migrations->contains(function ($value, $key) use ($migration) {
                if (Str::contains($value->getRelativePathname(), $migration->getFilenameWithoutExtension())) {
                    return true;
                }
            })) {
                $migrations[__DIR__.'/../../database/migrations/'.$migration->getRelativePathname()] = database_path('migrations/'.date('Y_m_d_His').'_'.$migration->getFilenameWithoutExtension());
            }
        }

        return $migrations;
    }

}
