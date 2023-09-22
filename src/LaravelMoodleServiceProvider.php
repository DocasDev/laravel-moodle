<?php
namespace DocasDev\LaravelMoodle;

use Illuminate\Support\ServiceProvider;

class LaravelMoodleServiceProvider extends ServiceProvider
{
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

    public function register()
    {
        $configPath = __DIR__ . '/../config/laravel-moodle.php';
        $this->mergeConfigFrom($configPath, 'laravel-moodle');
    }
}
