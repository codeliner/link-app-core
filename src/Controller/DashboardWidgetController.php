<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 06.12.14 - 22:32
 */

use Prooph\Link\Application\Controller;

use Dashboard\Controller\AbstractWidgetController;
use Dashboard\View\DashboardWidget;
use Prooph\Link\Application\Projection\ProcessingConfig;
use Prooph\Link\Application\Service\NeedsSystemConfig;

/**
 * Class DashboardWidgetController
 *
 * @package SystemConfig\src\Controller
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class DashboardWidgetController extends AbstractWidgetController
{
    /**
     * @return DashboardWidget
     */
    public function widgetAction()
    {
        $params = [];

        $params['processingConfig'] = $this->systemConfig;

        $params['config_dir_is_writable'] = is_writable($this->systemConfig->getConfigLocation()->toString());

        if ($this->systemConfig->isConfigured()) {
            $params['config_is_writable'] = is_writable($this->systemConfig->getConfigLocation()->toString() . DIRECTORY_SEPARATOR . \SystemConfig\Model\ProcessingConfig::configFileName());
        } else {
            $params['config_is_writable'] = true;
        }

        $params['config_dir'] = $this->systemConfig->getConfigLocation()->toString();
        $params['config_file_name'] = \SystemConfig\Model\ProcessingConfig::configFileName();



        return DashboardWidget::initialize('system-config/dashboard/widget', 'System Configuration', 4, $params);
    }
}
 