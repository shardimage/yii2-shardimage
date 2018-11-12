<?php

/**
 * @link https://www.shardimage.com/
 *
 * @copyright Copyright (c) 2017 Shardimage
 * @license https://github.com/shardimage/yii2-shardimage/blob/master/LICENCE.md
 */

namespace shardimage\yii2shardimage;

use Yii;
use yii\log\Logger as YiiLogger;
use Psr\Log\LogLevel;
use shardimage\shardimagephp\loggers\BaseLogger;

/**
 * Logger implementation which passes the log messages to the Yii logger.
 */
class Logger extends BaseLogger
{
    /**
     * @var array
     */
    private static $yiiLogLevels = [
        LogLevel::EMERGENCY => YiiLogger::LEVEL_ERROR,
        LogLevel::ALERT => YiiLogger::LEVEL_ERROR,
        LogLevel::CRITICAL => YiiLogger::LEVEL_ERROR,
        LogLevel::ERROR => YiiLogger::LEVEL_ERROR,
        LogLevel::WARNING => YiiLogger::LEVEL_WARNING,
        LogLevel::NOTICE => YiiLogger::LEVEL_WARNING,
        LogLevel::INFO => YiiLogger::LEVEL_INFO,
        LogLevel::DEBUG => YiiLogger::LEVEL_TRACE,
    ];

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = [])
    {
        Yii::getLogger()->log(
            $this->interpolate($message, $context),
            $this->psrToYiiLevel($level),
            'yii2-shardimage'
        );
    }

    /**
     * @param string $level
     *
     * @return string
     */
    private function psrToYiiLevel($level)
    {
        return self::$yiiLogLevels[$level] ?? YiiLogger::LEVEL_TRACE;
    }
}
