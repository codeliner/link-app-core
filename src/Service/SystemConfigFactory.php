<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 08.01.15 - 23:50
 */

use Prooph\Link\Application\Service;

use Prooph\Link\Application\SharedKernel\ConfigLocation;
use Prooph\Link\Application\Definition;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SystemConfigFactory
 *
 * @package SystemConfig\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class SystemConfigFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return \SystemConfig\Model\ProcessingConfig::asProjectionFrom($serviceLocator->get('application.config_location'));
    }
}
 