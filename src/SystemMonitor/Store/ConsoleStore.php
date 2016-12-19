<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor\Store;

use JildertMiedema\SystemMonitor\System\MeasurementStore;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsoleStore implements MeasurementStore
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Store a time based measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeTimer(string $name, $value)
    {
        $this->output->writeln(sprintf('Timing %s: %s', $name, $value));
    }

    /**
     * Store a gauge measurement.
     *
     * @param string    $name  The name of the measurement
     * @param int|float $value The value of the measurement
     */
    public function storeGauge(string $name, $value)
    {
        $this->output->writeln(sprintf('Gauge %s: %s', $name, $value));
    }
}
