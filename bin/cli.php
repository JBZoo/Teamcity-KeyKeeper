#!/usr/bin/env php
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

use JBZoo\TeamcityKeyKeeper\KeyRestoreCommand;
use JBZoo\TeamcityKeyKeeper\KeySaveCommand;
use Symfony\Component\Console\Application;

umask(0000);
set_time_limit(0);

define('PATH_ROOT', __DIR__ . '/../');
define('PATH_STORAGE', PATH_ROOT . '/storage');

require_once PATH_ROOT . '/vendor/autoload.php';

$application = new Application();
$application->add(new KeySaveCommand());
$application->add(new KeyRestoreCommand());
$application->run();
