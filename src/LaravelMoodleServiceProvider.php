<?php
namespace DocasDev\LaravelMoodle;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelMoodleServiceProvider
 * @package DocasDev\LaravelMoodle
 */
class LaravelMoodleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/laravel-moodle.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('laravel-moodle.php');
        } else {
            $publishPath = base_path('config/laravel-moodle.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/laravel-moodle.php';
        $this->mergeConfigFrom($configPath, 'laravel-moodle');
    }
}
