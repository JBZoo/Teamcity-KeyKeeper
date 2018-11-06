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

use JBZoo\Utils\Cli;
use QuickBooksOnline\API\Core\CoreConstants;
use QuickBooksOnline\API\DataService\DataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QbUpdateCommand
 * @package JBZoo\TeamcityKeyKeeper
 */
class QbUpdateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('qb:update')
            ->setDescription('Update tokens for QuickBooks');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scope = 'com.intuit.quickbooks.accounting';

        $config = [
            'auth_mode'       => CoreConstants::OAUTH2,
            'scope'           => $scope,
            'ClientID'        => $this->getConfig('qb_client_id'),
            'ClientSecret'    => $this->getConfig('qb_client_secret'),
            'QBORealmID'      => $this->getConfig('qb_realm_id'),
            'RedirectURI'     => $this->getConfig('qb_redirect_url'),
            'baseUrl'         => CoreConstants::DEVELOPMENT_SANDBOX,
            'accessTokenKey'  => $this->getConfig('qb_access_token'),
            'refreshTokenKey' => $this->getConfig('qb_refresh_token'),
        ];

        $dataService = DataService::Configure($config);

        $qbToken = $dataService->getOAuth2LoginHelper()->refreshToken();
        $this->saveConfig('qb_access_token', $qbToken->getAccessToken());
        $this->saveConfig('qb_refresh_token', $qbToken->getRefreshToken());

        Cli::out($dataService->getCompanyInfo()->CompanyName);
    }

    /**
     * @param string $keyName
     * @return string
     */
    protected function getConfig($keyName)
    {
        return trim(Cli::exec('teamcity-keykeeper key:get', ['name' => $keyName]));
    }

    /**
     * @param string $keyName
     * @param string $value
     */
    protected function saveConfig($keyName, $value)
    {
        $response = trim(Cli::exec('teamcity-keykeeper key:save', ['name' => $keyName, 'value' => $value]));
        Cli::out($response);
    }
}
