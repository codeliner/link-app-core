<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 08.01.15 - 15:25
 */

namespace Prooph\Link\Application\SharedKernel\Factory;

use Prooph\Link\Application\SharedKernel\LocationTranslator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LocationTranslatorFactory
 *
 * @package Application\SharedKernel\Factory
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class LocationTranslatorFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        $locations = isset($config['locations'])? $config['locations'] : [];

        return new LocationTranslator($locations);
    }
}
 