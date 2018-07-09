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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class KeyGetCommand
 * @package JBZoo\TeamcityKeyKeeper
 */
class KeyGetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('key:get')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Name of key')
            ->addOption('group', null, InputOption::VALUE_OPTIONAL, 'Group of keys', 'default')
            ->setDescription('Get clean value of key');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = strtoupper(trim($input->getOption('name')));
        $group = trim($input->getOption('group'));

        $storage = new JSON(realpath(PATH_STORAGE . "/{$group}.json") ?: []);
        $output->write(trim($storage->get($name)) ?: '');
    }
}
