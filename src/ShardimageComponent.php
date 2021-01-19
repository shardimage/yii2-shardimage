<?php

/**
 * @link https://www.shardimage.com/
 *
 * @copyright Copyright (c) 2021 Shardimage
 * @license https://github.com/shardimage/yii2-shardimage/blob/master/LICENCE.md
 */

namespace shardimage\yii2shardimage;

use shardimage\shardimagephp\auth\Client;
use shardimage\shardimagephp\services\AccessTokenService;
use shardimage\shardimagephp\services\SuperBackupService;
use shardimage\shardimagephp\services\BillingService;
use shardimage\shardimagephp\services\CloudService;
use shardimage\shardimagephp\services\DataService;
use shardimage\shardimagephp\services\FirewallService;
use shardimage\shardimagephp\services\ImageService;
use shardimage\shardimagephp\services\JobService;
use shardimage\shardimagephp\services\SystemService;
use shardimage\shardimagephp\services\UploadService;
use shardimage\shardimagephp\services\UrlService;
use shardimage\shardimagephp\services\SuperBackupLogService;
use shardimage\shardimagephpapi\services\dump\DumpServiceInterface;
use yii\di\Instance;
use Psr\Log\LoggerInterface;

/**
 * Shardimage Yii2 component.
 */
class ShardimageComponent extends \yii\base\Component
{
    /**
     * @var string Shardimage API host
     */
    public $apiHost = 'https://api.shardimage.com';

    /**
     * @var string Shardimage API key
     */
    public $apiKey;

    /**
     * @var string Shardimage API secret
     */
    public $apiSecret;

    /**
     * @var string Shardimage Image secret
     */
    public $imageSecret;

    /**
     * @var string Shardimage API access token
     */
    public $apiAccessToken;

    /**
     * @var string Shardimage API access token secret
     */
    public $apiAccessTokenSecret;

    /**
     * @var string Shardimage API config
     */
    public $apiConfig;

    /**
     * @var string Shardimage image host
     */
    public $imageHost = 'https://img.shardimage.com';

    /**
     * @var string Default cloud ID
     */
    public $cloudId;

    /**
     * @var bool Enable debugging
     */
    public $debug = false;

    /**
     * @var LoggerInterface|string|array Logger instance, classname, or an application component ID.
     * The logger must implement the PSR-3 LoggerInterface!
     */
    public $logger = Logger::class;

    /**
     * @var bool Enable gzip compression
     */
    public $useGzip = true;

    /**
     * @var bool Enable using MsgPack
     */
    public $useMsgPack = true;

    /**
     * @var bool Allow dismissing soft exceptions
     */
    public $softExceptionEnabled = true;

    /**
     * @var string Proxy settings (protocol://host:port)
     */
    public $proxy;

    /**
     * @var CacheInterface Cache interface
     */
    public $cache;

    /**
     * @var int Cache expiration
     */
    public $cacheExpiration;

    /**
     * @var int Request timeout [sec]
     */
    public $timeout = 180;

    /**
     * @var int Maximal task count per batch request
     */
    public $batchLimit = 100;

    /**
     * @var DumpServiceInterface dumping service object
     */
    public $dumpService;

    /**
     * @var \shardimage\shardimagephp\auth\Client
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->logger) {
            $this->logger = Instance::ensure($this->logger, LoggerInterface::class);
        }

        $this->client = new Client([
            'apiHost' => $this->apiHost,
            'apiKey' => $this->apiKey,
            'apiSecret' => $this->apiSecret,
            'imageSecret' => $this->imageSecret,
            'apiAccessToken' => $this->apiAccessToken,
            'apiAccessTokenSecret' => $this->apiAccessTokenSecret,
            'apiConfig' => $this->apiConfig,
            'imageHost' => $this->imageHost,
            'cloudId' => $this->cloudId,
            'debug' => $this->debug,
            'logger' => $this->logger,
            'useGzip' => $this->useGzip,
            'useMsgPack' => $this->useMsgPack,
            'softExceptionEnabled' => $this->softExceptionEnabled,
            'proxy' => $this->proxy,
            'cache' => $this->cache,
            'cacheExpiration' => $this->cacheExpiration,
            'timeout' => $this->timeout,
            'batchLimit' => $this->batchLimit,
            'dumpService' => $this->dumpService,
        ]);
    }

    /**
     * Sets client's image host.
     *
     * @param string $imageHost
     */
    public function setImageHost(string $imageHost)
    {
        if ($this->client) {
            $this->client->imageHost = $imageHost;
        }
    }

    /**
     * Access token service.
     *
     * @return AccessTokenService
     */
    public function accessToken()
    {
        return $this->client->getAccessTokenService();
    }

    /**
     * SuperBackup service.
     *
     * @return SuperBackupService
     */
    public function superBackup()
    {
        return $this->client->getSuperBackupService();
    }

    /**
     * Billing service.
     *
     * @return BillingService
     */
    public function billing()
    {
        return $this->client->getBillingService();
    }

    /**
     * Cloud service.
     *
     * @return CloudService
     */
    public function cloud()
    {
        return $this->client->getCloudService();
    }

    /**
     * Data service.
     *
     * @return DataService
     */
    public function data()
    {
        return $this->client->getDataService();
    }

    /**
     * Firewall service.
     *
     * @return FirewallService
     */
    public function firewall()
    {
        return $this->client->getFirewallService();
    }

    /**
     * Image service.
     *
     * @return ImageService
     */
    public function image()
    {
        return $this->client->getImageService();
    }

    /**
     * Job service.
     *
     * @return JobService
     */
    public function job()
    {
        return $this->client->getJobService();
    }

    /**
     * System service.
     *
     * @return SystemService
     */
    public function system()
    {
        return $this->client->getSystemService();
    }

    /**
     * Upload service.
     *
     * @return UploadService
     */
    public function upload()
    {
        return $this->client->getUploadService();
    }

    /**
     * URL service.
     *
     * @return UrlService
     */
    public function url()
    {
        return $this->client->getUrlService();
    }

    /**
     * SuperBackup log service
     *
     * @return SuperBackupLogService
     */
    public function superBackupLog()
    {
        return $this->client->getSuperBackupLogService();
    }

    /**
     * Starts/ends deferring of operations (max. 100).
     *
     * @param bool $enable Deferring status
     *
     * @return mixed
     */
    public function defer($enable)
    {
        return $this->client->defer($enable);
    }
}
