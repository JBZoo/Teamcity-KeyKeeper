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

namespace JBZoo\PHPUnit;

use JBZoo\Utils\Cli;
use JBZoo\Utils\Str;

/**
 * Class PackageTest
 * @package JBZoo\PHPUnit
 */
class KeyKeeperTest extends PHPUnit
{
    public function setUp()
    {
        $storageFile = __DIR__ . '/../storage/default.json';
        if (file_exists($storageFile)) {
            unlink($storageFile);
        }
    }

    public function testSaveAndRestoreKey()
    {
        $bin = realpath(__DIR__ . '/../bin/teamcity-keykeeper');
        $value = Str::random(10000);
        $name = Str::random();

        $saveResult = trim(Cli::exec("php {$bin} key:save --name='{$name}' --value='{$value}'"));
        isContain("Key '{$name}' saved", $saveResult);

        $restoreResult = trim(Cli::exec("php {$bin} key:restore --name='{$name}'"));
        isSame("##teamcity[setParameter name='env.{$name}' value='{$value}']", $restoreResult);
    }

    public function testSpecialChars()
    {
        $bin = realpath(__DIR__ . '/../bin/teamcity-keykeeper');
        $value = 'qwerty1234567890-!@#$%^&*()_+.<>,;{}№';
        $name = 'qwerty1234567890-!@#$%^&*()_+.<>,;{}№';

        $saveResult = trim(Cli::exec("php {$bin} key:save --name='{$name}' --value='{$value}'"));
        isContain("Key '{$name}' saved", $saveResult);

        $restoreResult = trim(Cli::exec("php {$bin} key:restore --name='{$name}'"));
        isSame("##teamcity[setParameter name='env.{$name}' value='{$value}']", $restoreResult);
    }

    public function testGetAllKeys()
    {
        $bin = realpath(__DIR__ . '/../bin/teamcity-keykeeper');

        Cli::exec("php {$bin} key:save --name='key1' --value='value1'");
        Cli::exec("php {$bin} key:save --name='key2' --value='value2'");

        $restoreResult = trim(Cli::exec("php {$bin} key:restore --all"));
        isContain("##teamcity[setParameter name='env.key1' value='value1']", $restoreResult);
        isContain("##teamcity[setParameter name='env.key2' value='value2']", $restoreResult);
    }
}
