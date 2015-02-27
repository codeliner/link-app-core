<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 30.12.14 - 18:13
 */

namespace Prooph\Link\Application\Model\ProcessingConfig;

use Prooph\Link\Application\Command\ChangeProcessConfig;
use Prooph\Link\Application\Model\ProcessingConfig;

/**
 * Class ChangeProcessConfigHandler
 *
 * @package SystemConfig\Model\ProcessingConfig
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ChangeProcessConfigHandler extends SystemConfigChangesHandler
{
    /**
     * @param ChangeProcessConfig $command
     */
    public function handle(ChangeProcessConfig $command)
    {
        $processingConfig = ProcessingConfig::initializeFromConfigLocation($command->configLocation());

        $processingConfig->replaceProcessTriggeredBy($command->startMessage(), $command->processConfig(), $this->configWriter);

        $this->publishChangesOf($processingConfig);
    }
}
 