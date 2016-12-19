<?php

declare(strict_types=1);

namespace Tests;

use JildertMiedema\SystemMonitor\System\MeasurementStore;

final class MockStore implements MeasurementStore
{
    private $gauges = [];
    private $timers = [];

    /**
     * Store a time based measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeTimer(string $name, $value)
    {
        $this->timers[$name] = $value;
    }

    /**
     * Store a gauge measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeGauge(string $name, $value)
    {
        $this->gauges[$name] = $value;
    }

    /**
     * @return array
     */
    public function gauges(): array
    {
        return $this->gauges;
    }

    /**
     * @return array
     */
    public function timers(): array
    {
        return $this->timers;
    }
}
