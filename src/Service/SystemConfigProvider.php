<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 30.12.14 - 16:46
 */

use Prooph\Link\Application\Service;

use Prooph\Link\Application\SharedKernel\ConfigLocation;
use Prooph\Link\Application\Definition;
use Prooph\Link\Application\Projection\ProcessingConfig;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SystemConfigProvider
 *
 * ServiceManager initializer that injects the system config projection when an object implements the NeedsSystemConfig interface.
 *
 * @package SystemConfig\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class SystemConfigProvider implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof NeedsSystemConfig) {
            if ($serviceLocator instanceof ControllerManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $instance->setSystemConfig($serviceLocator->get('system_config'));
        }
    }
}
 