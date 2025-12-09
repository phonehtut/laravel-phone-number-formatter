<?php
namespace NewwaySo\PhoneNumberFormatter;

use Illuminate\Support\ServiceProvider;

class PhoneNumberFormatterServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind facade
        $this->app->singleton('phoneformatter', function() {
            return new PhoneNumberFormatter();
        });
    }

    public function boot()
    {
        // Optionally, publish config
        $this->publishes([
            __DIR__.'/../config/phoneformatter.php' => config_path('phoneformatter.php'),
        ], 'config');
    }
}
