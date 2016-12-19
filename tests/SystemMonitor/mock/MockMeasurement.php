<?php

declare(strict_types=1);

namespace Tests;

use JildertMiedema\SystemMonitor\Measurements\Measurement;
use JildertMiedema\SystemMonitor\System\MeasurementStore;

final class MockMeasurement implements Measurement
{
    /**
     * The name of the.
     *
     * @return string
     */
    public function name(): string
    {
        return 'tests.mock';
    }

    /**
     * Runs the measurement.
     *
     * @param MeasurementStore $store
     * @param array            $data
     */
    public function run(MeasurementStore $store, array $data)
    {
        $key = array_get($data, 'key');
        $store->storeGauge($key, 1);
    }
}
