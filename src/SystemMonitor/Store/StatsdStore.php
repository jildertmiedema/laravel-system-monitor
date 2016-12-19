<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Store;

use JildertMiedema\SystemMonitor\System\MeasurementStore;
use League\StatsD\Client;

final class StatsdStore implements MeasurementStore
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Store a time based measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeTimer(string $name, $value)
    {
        $this->client->timing($name, $value);
    }

    /**
     * Store a gauge measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeGauge(string $name, $value)
    {
        $this->client->gauge($name, $value);
    }
}
