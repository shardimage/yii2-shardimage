# Yii2-Shardimage

Yii2 Wrapper for Shardimage PHP

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
composer require shardimage/yii2-shardimage
```

## Usage

Once the extension is installed, simply use it in your code by:

### Config

```php
'components' => [
    // ...
    'shardimage' => [
        // Component class
        'class' => \shardimage\yii2shardimage\Component::class,
        // API host, default: https://api.shardimage.com
        'apiHost' => 'https://api.shardimage.com',
        // API key (generated on shardimage.com)
        'apiKey' => '6174447875126537682',
        // API secret (generated on shardimage.com)
        'apiSecret' => '5Tgzi4InVtbuKRao0LYBv4rfkGp7SFZgC6cXymsf',
        // Image secret (generated on shardimage.com)
        'imageSecret' => 'XUEpxvCkHcKWf0qL89uy1tbezR5FONQYiSM7mn4j',
        // One-time API access token
        'apiAccessToken' => '0uiW-qKOIjIcAdt8LEMnusose5XV8qEb6351ZFaN',
        // One-time API access token secret
        'apiAccessTokenSecret' => 'g37rei4353frj5746',
        // API key, secret and cloud ID in URL format
        'apiConfig' => 'apiKey:apiSecret@cloudId',
        // Host for serving images, default: https://img.shardimage.com
        'imageHost' => 'https://img.shardimage.com',
        // Default cloud ID
        'cloudId' => 'R0Cu47n0',
        // Print debug log to console, default: false
        'debug' => true,
        // Logger instance, classname, or an application component ID.
        'logger' => Logger::class,
        // Use gzip in HTTP communication, default: true
        'useGzip' => true,
        // Use PHP MsgPack in HTTP communication, default: true
        'useMsgPack' => true,
        // Dismiss non-fatal exceptions, default: true
        'softExceptionEnabled' => true,
        // Proxy in HTTP communication
        'proxy' => 'http://127.0.0.1:8080',
        // Cache instance for the Etag handler
        'cache' => new \yii\caching\FileCache(),
        // Cache expiration in seconds, in accordance with the used caching mechanism
        'cacheExpiration' => 3600,
    ],
    // ...
],
```

## Usage

### Manage Clouds

```php
/* @var $service \shardimage\shardimagephp\services\CloudService */
$service = Yii::$app->shardimage->cloud();
```

### Manage Backups

```php
/* @var $service \shardimage\shardimagephp\services\BackupService */
$service = Yii::$app->shardimage->backup();
```

### Manage Firewalls

```php
/* @var $service \shardimage\shardimagephp\services\FirewallService */
$service = Yii::$app->shardimage->firewall();
```

### Manage Images

```php
/* @var $service \shardimage\shardimagephp\services\ImageService */
$service = Yii::$app->shardimage->image();
```

### Manage Uploads

```php
/* @var $service \shardimage\shardimagephp\services\UploadService */
$service = Yii::$app->shardimage->upload();
```

### Manage Urls

```php
/* @var $service \shardimage\shardimagephp\services\UrlService */
$service = Yii::$app->shardimage->url();
```

For more informations, please check the [Shardimage PHP package](https://github.com/shardimage/shardimage-php) or the [Shardimage documentation](https://developers.shardimage.com).

## Changelog

All notable changes to this project will be documented in the [CHANGELOG](CHANGELOG.md) file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## License

[Read more >>](https://github.com/shardimage/yii2-shardimage/blob/master/LICENCE.md)

## Links

 - [Shardimage](https://shardimage.com)
 - [Shardimage PHP SDK](https://github.com/shardimage/shardimage-php)
 - [Shardimage PHP SDK Documentation](https://developers.shardimage.com/sdk/php/latest)
 - [Shardimage documentation](https://developers.shardimage.com)
 - [Shardimage blog](https://shardimage.com/blog)