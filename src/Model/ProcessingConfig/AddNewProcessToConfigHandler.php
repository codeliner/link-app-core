<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 12/14/14 - 10:05 PM
 */
namespace Prooph\Link\Application\Model\ProcessingConfig;

use Prooph\Link\Application\Command\AddNewProcessToConfig;
use Prooph\Link\Application\Model\ProcessingConfig;

/**
 * Class CreateProcessHandler
 *
 * Adds a new process definition to processing config
 *
 * @package SystemConfig\Model\ProcessingConfig
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class AddNewProcessToConfigHandler extends SystemConfigChangesHandler
{
    /**
     * @param AddNewProcessToConfig $command
     */
    public function handle(AddNewProcessToConfig $command)
    {
        $processingConfig = ProcessingConfig::initializeFromConfigLocation($command->configLocation());

        $processingConfig->addProcess(
            $command->processName(),
            $command->processType(),
            $command->startMessage(),
            $command->tasks(),
            $this->configWriter
        );

        $this->publishChangesOf($processingConfig);
    }
} 