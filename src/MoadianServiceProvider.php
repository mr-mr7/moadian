<?php

namespace Jooyeshgar\Moadian;

use Illuminate\Support\ServiceProvider;

class MoadianServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/moadian.php', 'moadian'
        );

        $this->app->singleton('Jooyeshgar\Moadian\Moadian', function ($app) {
            $config = $app['config']['moadian'];
            if (!$config['multi_moadi']) {
                $privateKeyPath = $config['private_key_path'] ?? 'app/keys/private.pem';
                $certificatePath = $config['certificate_path'] ?? 'app/keys/certificate.crt';
                return new Moadian($config['username'], $privateKeyPath, $certificatePath);
            }
            return new Moadian();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/moadian.php' => config_path('moadian.php'),
                __DIR__ . '/database/migrations/add_moadian_credentials_to_users_table.php.stub' => database_path('migrations/2025_08_25_134348_add_moadian_credentials_to_users_table.php'),
            ], 'moadian');
        }
    }
}
