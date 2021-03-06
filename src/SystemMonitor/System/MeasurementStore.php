<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\System;

interface MeasurementStore
{
    /**
     * Store a time based measurement.
     *
     * @param string           $name  The name of the measurement
     * @param int|float|string $value The value of the measurement
     */
    public function storeTimer(string $name, $value);

    /**
     * Store a gauge measurement.
     *
     * @param string           $name  The name of the measurement
     * @param int|float|string $value The value of the measurement
     */
    public function storeGauge(string $name, $value);
}
