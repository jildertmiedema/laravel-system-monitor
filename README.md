# laravel-system-monitor

[![Author](http://img.shields.io/badge/author-@jildertmiedema-blue.svg?style=flat-square)](https://twitter.com/jildertmiedema)
[![Build Status](https://img.shields.io/travis/jildertmiedema/laravel-system-monitor/master.svg?style=flat-square)](https://travis-ci.org/jildertmiedema/laravel-system-monitor)
[![Quality Score](https://img.shields.io/scrutinizer/g/jildertmiedema/laravel-system-monitor.svg?style=flat-square)](https://scrutinizer-ci.com/g/jildertmiedema/laravel-system-monitor)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/jildertmiedema/laravel-system-monitor.svg?style=flat-square)](https://packagist.org/packages/jildertmiedema/laravel-system-monitor)
[![Total Downloads](https://img.shields.io/packagist/dt/jildertmiedema/laravel-system-monitor.svg?style=flat-square)](https://packagist.org/packages/jildertmiedema/laravel-system-monitor)

This package will be monitor application metrices. 
It is dynamic configurable, but with the default settings you will be able to show some basic stuff.

This package usage statsd as a default output but off course you can implement your own store

## Install

This package depends on the [statsd client](https://github.com/thephpleague/statsd) from the php league. 
Read their manual to get it up and running

Install the package:
```sh
composer require jildertmiedema/laravel-system-monitor
```

Add these lines in the `config/app.php` file in the `providers` array.
```php
JildertMiedema\SystemMonitor\SystemMonitorServiceProvider::class,
League\StatsD\Laravel5\Provider\StatsdServiceProvider::class,
```

If you've added the `artisan schedule:run` command to your cron, then you can add this to your `App\Console\Kernel` class
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('measurement:run')->everyMinute();
}
```
Now the system will send the measurement results to Statsd every minute

## Configuration

To publish the config use:

```php
php artisan vendor:publish --tag="config"
```
Change the `config/measurement.php` file to your needs.

Measurements can be configured by choosing a `type` and `key`.
The `type` is the type of the type of the measurement.
The `key` is the statsd key.
Per type some additional settings are required. 

 * `mysql.speed` The reaction time of a mysql connection. (Configure a `connection`)
 * `redis.speed` The reaction time of a redis connection. (Configure a `connection`)
 * `queue.size` Measures to amount of items in the queue. (Configure a `queue`)
 * `queue.waiting-time` Put a job on the queue and measures how long it takes before its handled by the queue. (Configure a `queue`)

## Testing
Run this command to show the result as console output.
`php artisan measurement:run  --debug`

## Statsd server
This package is design to be send to a statsd server. 
Of course you can implement your own `MeasurementStore` to send it elsewhere.
Some docker stuff is created to receive (and show) data. [Show me](https://github.com/jildertmiedema/statsd-logging)

## Extending
This package comes with a default setup, but you can easly extend or replace parts.

To create your own measurement, create a new class that implements the `JildertMiedema\SystemMonitor\Measurements\Measurement` interface.
To register your class insert this in a service provider:
```php
use JildertMiedema\SystemMonitor\Measurements\Manager;

$this->app->resolving('measurement', function (Manager $manager) {
    $manager->extend($this->app[YourMeasurementClass::class]);
});
```