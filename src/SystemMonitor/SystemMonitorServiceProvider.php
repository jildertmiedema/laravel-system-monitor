<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor;

use Illuminate\Support\ServiceProvider;
use JildertMiedema\SystemMonitor\Console\MeasurementRun;
use JildertMiedema\SystemMonitor\Measurements\MysqlConnectionSpeed;
use JildertMiedema\SystemMonitor\Measurements\QueueSize;
use JildertMiedema\SystemMonitor\Measurements\QueueWaitingTime;
use JildertMiedema\SystemMonitor\Measurements\RedisConnectionSpeed;
use JildertMiedema\SystemMonitor\Store\StatsdStore;

final class SystemMonitorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('measurement', function () {
            return new Manager($this->app);
        });

        $this->app->bind('measurement.store', function () {
            return $this->app[StatsdStore::class];
        });

        $this->app->resolving('measurement', function (Manager $manager) {
            $manager->extend($this->app[MysqlConnectionSpeed::class]);
            $manager->extend($this->app[RedisConnectionSpeed::class]);
            $manager->extend($this->app[QueueWaitingTime::class]);
            $manager->extend($this->app[QueueSize::class]);
        });

        $this->app->singleton('command.measurement.run', function () {
            return new MeasurementRun();
        });

        $this->commands('command.measurement.run');
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishes([
            $this->getConfigPath() => config_path('measurement.php'),
        ], 'config');
    }

    private function getConfigPath()
    {
        return __DIR__.'/../../config/measurement.php';
    }
}
