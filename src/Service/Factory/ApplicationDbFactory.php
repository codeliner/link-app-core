<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 11.01.15 - 22:59
 */

namespace Prooph\Link\Application\Service\Factory;

use Doctrine\DBAL\DriverManager;
use Prooph\EventStore\EventStore;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ApplicationDbFactory
 *
 * @package Application\Service\Factory
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ApplicationDbFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \InvalidArgumentException
     * @return \Doctrine\DBAL\Connection
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        if (! array_key_exists('application_db', $config)) throw new \InvalidArgumentException('Missing config for application_db');

        $config = $config['application_db'];

        if (isset($config['use_event_store_adapter_connection']) && $config['use_event_store_adapter_connection']) {
            /** @var $es EventStore */
            $es = $serviceLocator->get('proophessor.event_store');

            return DoctrineEventStoreAdapterDecorator::getConnectionOfAdapter($es->getAdapter());
        } else {
            if (! array_key_exists('connection', $config)) throw new \InvalidArgumentException('Missing connection in application_db config');

            return DriverManager::getConnection($config['connection']);
        }
    }
}
 