<?php

namespace JildertMiedema\SystemMonitor\System;

interface MeasurementStore
{
    /**
     * Store a time based measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeTimer(string $name, $value);

    /**
     * Store a gauge measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeGauge(string $name, $value);
}
