<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 12/8/14 - 5:47 PM
 */
namespace Prooph\Link\Application\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ActionControllerInitializer
 *
 * @package Application\src\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ActionControllerInitializer implements InitializerInterface
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
        if ($instance instanceof ActionController) {
            //We are dealing with a ControllerManager so we need to get the main service manger first
            $instance->setCommandBus($serviceLocator->getServiceLocator()->get('prooph.psb.command_bus'));
        }
    }
}