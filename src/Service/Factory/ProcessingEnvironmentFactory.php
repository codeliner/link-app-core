<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 10.01.15 - 22:34
 */

namespace Prooph\Link\Application\Service\Factory;

use Prooph\Processing\Environment\Environment;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ProcessingEnvironmentFactory
 *
 * @package Application\SharedKernel\Factory
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessingEnvironmentFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return Environment::setUp($serviceLocator);
    }
}
 