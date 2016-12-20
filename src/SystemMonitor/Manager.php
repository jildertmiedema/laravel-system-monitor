<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor;

use Illuminate\Contracts\Container\Container;
use JildertMiedema\SystemMonitor\Measurements\Measurement;

final class Manager
{
    /**
     * @var Measurement[]
     */
    private $types = [];

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function extend(Measurement $class)
    {
        $this->types[$class->name()] = $class;
    }

    public function run()
    {
        $measurements = $this->container['config']->get('measurement.measurements', []);
        $store = $this->container['measurement.store'];

        foreach ($measurements as $measurement) {
            $type = array_get($measurement, 'type');
            $key = array_get($measurement, 'key');

            if (!$type || !$key) {
                $message = 'The measurement configuration needs at least a type and a key';
                throw new MeasurementConfigurationError($message);
            }

            $runner = $this->types[$type];

            $runner->run($store, $measurement);
        }
    }
}
