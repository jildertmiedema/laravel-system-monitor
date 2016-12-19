<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Console;

use Illuminate\Console\Command;
use JildertMiedema\SystemMonitor\Store\ConsoleStore;

final class MeasurementRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'measurement:run {--debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all measurements';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('debug')) {
            app()->bind('measurement.store', function () {
                return new ConsoleStore($this->output);
            });
        }

        $manager = app('measurement');
        $manager->run();
    }
}
