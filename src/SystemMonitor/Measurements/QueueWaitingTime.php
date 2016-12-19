<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Measurements;

use Illuminate\Contracts\Queue\Queue;
use JildertMiedema\SystemMonitor\Measurements\Queue\WaitingTimeJob;
use JildertMiedema\SystemMonitor\System\MeasurementStore;

final class QueueWaitingTime implements Measurement
{
    /**
     * @var Queue
     */
    private $queue;

    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * The name of the.
     *
     * @return string
     */
    public function name(): string
    {
        return 'queue.waiting-time';
    }

    /**
     * Runs the measurement.
     *
     * @param MeasurementStore $store
     * @param array            $data
     */
    public function run(MeasurementStore $store, array $data)
    {
        $queue = array_get($data, 'queue');
        $key = array_get($data, 'key');

        $timerStart = microtime(true);

        $job = new WaitingTimeJob($timerStart, $key);

        $this->queue->pushOn($queue, $job);
    }
}
