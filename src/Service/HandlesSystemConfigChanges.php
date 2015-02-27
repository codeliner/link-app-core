<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 07.01.15 - 21:51
 */

namespace Prooph\Link\Application\Service;

use Prooph\ServiceBus\EventBus;
use Prooph\Link\Application\Model\ConfigWriter;

/**
 * Interface HandlesSystemConfigChanges
 *
 * @package SystemConfig\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface HandlesSystemConfigChanges
{
    /**
     * @param ConfigWriter $configWriter
     * @return void
     */
    public function setConfigWriter(ConfigWriter $configWriter);

    /**
     * @param EventBus $eventBus
     * @return void
     */
    public function setEventBus(EventBus $eventBus);
}
 