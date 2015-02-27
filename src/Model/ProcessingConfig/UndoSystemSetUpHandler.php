<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 02.01.15 - 17:00
 */

namespace Prooph\Link\Application\Model\ProcessingConfig;

use Prooph\Link\Application\Command\UndoSystemSetUp;
use Prooph\Link\Application\Model\EventStoreConfig;
use Prooph\Link\Application\Model\ProcessingConfig;

/**
 * Class UndoSystemSetUpHandler
 *
 * @package SystemConfig\Model\ProcessingConfig
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class UndoSystemSetUpHandler extends SystemConfigChangesHandler
{
    /**
     * @param UndoSystemSetUp $command
     */
    public function handle(UndoSystemSetUp $command)
    {
        $this->eventBus->dispatch(ProcessingConfig::removeConfig($command->processingConfigLocation()));
        $this->eventBus->dispatch(EventStoreConfig::undoEventStoreSetUp($command->eventStoreConfigLocation(), $command->sqliteDbFile()));
    }
}
 