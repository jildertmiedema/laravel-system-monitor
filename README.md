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

## Statsd server
Some docker stuff is create to receive (and show) data. [Show me](https://github.com/jildertmiedema/statsd-logging)
