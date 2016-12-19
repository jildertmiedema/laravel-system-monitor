<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Measurements;

use Illuminate\Database\Capsule\Manager;
use JildertMiedema\SystemMonitor\System\MeasurementStore;

final class MysqlConnectionSpeed implements Measurement
{
    /**
     * @var Manager
     */
    private $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * The name of the.
     *
     * @return string
     */
    public function name(): string
    {
        return 'mysql.speed';
    }

    /**
     * Runs the measurement.
     *
     * @param MeasurementStore $store
     * @param array            $data
     */
    public function run(MeasurementStore $store, array $data)
    {
        $connection = array_get($data, 'connection');
        $key = array_get($data, 'key');

        $database = $this->manager->getConnection($connection);

        $timerStart = microtime(true);
        $database->select('SELECT 1');
        $timerEnd = microtime(true);
        $time = round(($timerEnd - $timerStart) * 1000, 4);

        $store->storeTimer($key, $time);
    }
}
