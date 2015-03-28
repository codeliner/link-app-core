<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 07.12.14 - 20:21
 */

namespace Prooph\Link\Application\Controller;

use Prooph\Link\Application\Definition;
use Prooph\Link\Application\Model\ProcessingConfig;
use Prooph\Link\Application\Service\AbstractQueryController;
use Zend\View\Model\ViewModel;

/**
 * Class OverviewController
 *
 * @package SystemConfig\Controller
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class OverviewController extends AbstractQueryController
{
    /**
     * @return ViewModel
     */
    public function showAction()
    {
        $params = [];

        $params['processingConfig'] = $this->systemConfig;

        $params['workflow_processor_message_queue_available'] = $this->getServiceLocator()->has(Definition::APP_SERVICE_WORKFLOW_PROCESSOR_MESSAGE_QUEUE);

        $params['config_dir_is_writable'] = is_writable($this->systemConfig->getConfigLocation()->toString());

        if ($this->systemConfig->isConfigured()) {
            $params['config_is_writable'] = is_writable($this->systemConfig->getConfigLocation()->toString() . DIRECTORY_SEPARATOR . ProcessingConfig::configFileName());
        } else {
            $params['config_is_writable'] = true;
        }

        $params['config_dir'] = $this->systemConfig->getConfigLocation()->toString();
        $params['config_file_name'] = ProcessingConfig::configFileName();

        $model = new ViewModel($params);

        $model->setTemplate('prooph/link/system-config/overview/show');

        return $model;
    }
}
 