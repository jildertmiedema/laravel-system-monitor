<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Measurements\Queue;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;

final class WaitingTimeJob implements ShouldQueue
{
    /**
     * @var float
     */
    private $startTime;

    /**
     * @var string
     */
    private $key;

    /**
     * @param $startTime
     * @param string $key
     */
    public function __construct($startTime, string $key)
    {
        $this->startTime = $startTime;
        $this->key = $key;
    }

    public function handle(Container $container)
    {
        $store = $container->make('measurement.store');

        $timerEnd = microtime(true);
        $time = round(($timerEnd - $this->startTime) * 1000, 4);

        $store->storeTimer($this->key, $time.'|ms');
    }
}
