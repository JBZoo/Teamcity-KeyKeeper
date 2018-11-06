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

/**
 * Class QuickBooksTest
 * @package JBZoo\PHPUnit
 */
class QuickBooksTest extends PHPUnit
{
    public function testUpdate()
    {
        $saveResult = Cli::exec('teamcity-keykeeper qb:update');
        isContain("DON'T TOUCH IT! IT'S FOR CI!", $saveResult);
    }
}
