<?php

declare(strict_types=1);

namespace JildertMiedema\SystemMonitor;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Tests\MockMeasurement;
use Tests\MockStore;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @var MockStore
     */
    private $store;

    /**
     * @var Container
     */
    private $container;

    protected function setUp()
    {
        parent::setUp();
        require_once __DIR__.'/mock/MockMeasurement.php';
        require_once __DIR__.'/mock/MockStore.php';

        $this->config = new Repository();
        $this->store = new MockStore();

        $this->container = new Container();

        $this->container->singleton('config', function () {
            return $this->config;
        });
        $this->container->singleton('measurement.store', function () {
            return $this->store;
        });
    }

    public function testRun()
    {
        $this->config->set('measurement.measurements', [
            [
                'type' => 'tests.mock',
                'key' => 'test-key',
            ],
        ]);

        $manager = new Manager($this->container);

        $manager->extend(new MockMeasurement());

        $manager->run();

        $this->assertCount(1, $this->store->gauges());
        $this->assertSame(1, $this->store->gauges()['test-key']);
    }

    /**
     * @expectedException \JildertMiedema\SystemMonitor\MeasurementConfigurationError
     */
    public function testRunWithMissingKey()
    {
        $this->config->set('measurement.measurements', [
            [
                'type' => 'tests.mock',
            ],
        ]);

        $manager = new Manager($this->container);

        $manager->extend(new MockMeasurement());

        $manager->run();
    }

    /**
     * @expectedException \JildertMiedema\SystemMonitor\MeasurementConfigurationError
     */
    public function testRunWithMissingType()
    {
        $this->config->set('measurement.measurements', [
            [
                'key' => 'test-key',
            ],
        ]);

        $manager = new Manager($this->container);

        $manager->extend(new MockMeasurement());

        $manager->run();
    }
}
