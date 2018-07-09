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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class KeyRestoreCommand
 * @package JBZoo\TeamcityKeyKeeper
 */
class KeyRestoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('key:restore')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Name of key')
            ->addOption('group', null, InputOption::VALUE_OPTIONAL, 'Group of keys', Helper::DEFAULT_GROUP)
            ->addOption('all', null, InputOption::VALUE_NONE, 'Show all keys from group')
            ->setDescription('Restore key in Teamcity format');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $group = $input->getOption('group');

        if (!$input->getOption('all')) {
            $name = $input->getOption('name');
            $output->writeln(Helper::tcMessage($name, $group));
        } else {
            $rows = Helper::getKeys($group);
            foreach ($rows as $name => $value) {
                $output->writeln(Helper::tcMessage($name, $group));
            }
        }
    }
}
