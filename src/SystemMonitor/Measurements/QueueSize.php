<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Measurements;

use Illuminate\Contracts\Queue\Queue;
use JildertMiedema\SystemMonitor\System\MeasurementStore;

final class QueueSize implements Measurement
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
        return 'queue.size';
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

        $count = $this->queue->size($queue);

        $store->storeGauge($key, $count);
    }
}
