<?php
/**
 * JBZoo TeamcityKeyKeeper
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    TeamcityKeyKeeper
 * @license    MIT
 * @copyright  Copyright (C) JBZoo.com, All rights reserved.
 * @link       https://github.com/JBZoo/TeamcityKeyKeeper
 */

namespace JBZoo\TeamcityKeyKeeper;

use JBZoo\Data\JSON;

/**
 * Class Helper
 * @package JBZoo\TeamcityKeyKeeper
 */
class Helper
{
    const DEFAULT_GROUP = 'default';

    /**
     * @param string $key
     * @param string $value
     * @param string $group
     * @return string|bool
     */
    public static function saveKey($key, $value, $group = self::DEFAULT_GROUP)
    {
        $key = self::cleanName($key);
        $value = self::cleanValue($value);
        $storage = self::getStorage($group);

        if ($storage->is($key, $value, true)) {
            self::log("saveKey: '{$key}' not changed", $group);
            return false;
        }

        $storage->set($key, $value);
        file_put_contents(self::getStoragePath($group), (string)$storage);
        self::log("saveKey: '{$key}' updated" . ($value ? '' : ' to empty'), $group);

        return "Key '{$key}' saved";
    }

    /**
     * @param string $key
     * @param string $group
     * @return string
     */
    public static function getKey($key, $group = self::DEFAULT_GROUP)
    {
        $key = self::cleanName($key);
        self::log("getKey: '{$key}'", $group);
        return self::cleanValue(self::getStorage($group)->get($key)) ?: '';
    }

    /**
     * @param string $group
     * @return array
     */
    public static function getKeys($group = self::DEFAULT_GROUP)
    {
        self::log("getKeys: {$group}", $group);
        return self::getStorage($group)->getArrayCopy();
    }

    /**
     * @param string $storageName
     * @return JSON
     */
    public static function getStorage($storageName = self::DEFAULT_GROUP)
    {
        return new JSON(realpath(self::getStoragePath($storageName)) ?: []);
    }

    /**
     * @param string $group
     * @return string
     */
    private static function getStoragePath($group)
    {
        $group = self::cleanGroup($group);
        return PATH_STORAGE_DEFAULT . "/{$group}.json";
    }

    /**
     * @param string $name
     * @return string
     */
    private static function cleanName($name)
    {
        return strtoupper(trim($name));
    }

    /**
     * @param string $value
     * @return string
     */
    private static function cleanValue($value)
    {
        return trim($value) ?: '';
    }

    /**
     * @param string $name
     * @param string $group
     * @return string
     */
    public static function tcMessage($name, $group)
    {
        $name = self::cleanName($name);
        $value = self::getKey($name, $group);
        return "##teamcity[setParameter name='env.{$name}' value='{$value}']";
    }

    /**
     * @param string $message
     * @param string $group
     */
    private static function log($message, $group)
    {
        $group = self::cleanGroup($group);
        /** @noinspection ForgottenDebugOutputInspection */
        error_log(date('Y-m-d H:i:s') . "    {$message}\n", 3, PATH_STORAGE_DEFAULT . "/{$group}_log.log");
    }

    /**
     * @param $group
     * @return string
     */
    private static function cleanGroup($group)
    {
        return strtolower(trim($group)) ?: self::DEFAULT_GROUP;
    }
}
