<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Measurements;

use JildertMiedema\SystemMonitor\System\MeasurementStore;

interface Measurement
{
    /**
     * The name of the.
     *
     * @return string
     */
    public function name(): string;

    /**
     * Runs the measurement.
     *
     * @param MeasurementStore $store
     * @param array            $data
     */
    public function run(MeasurementStore $store, array $data);
}
