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
 * Class KeySaveCommand
 * @package JBZoo\TeamcityKeyKeeper
 */
class KeySaveCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('key:save')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Name of key')
            ->addOption('value', null, InputOption::VALUE_REQUIRED, 'Value of key')
            ->addOption('group', null, InputOption::VALUE_OPTIONAL, 'Group of keys', 'default')
            ->setDescription('Save key');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = trim($input->getOption('name'));
        $value = trim($input->getOption('value'));
        $group = strtolower(trim($input->getOption('group')));

        $storageFile = PATH_STORAGE . "/{$group}.json";

        $storage = new JSON(realpath($storageFile) ?: []);
        $storage->set($name, $value);
        file_put_contents($storageFile, $storage->__toString());

        $output->writeln("Key '{$name}' saved");
    }
}
