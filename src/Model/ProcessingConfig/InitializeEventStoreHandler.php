<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 02.01.15 - 12:49
 */

use Prooph\Link\Application\Model\ProcessingConfig;

use Prooph\ServiceBus\EventBus;
use Prooph\Link\Application\Command\InitializeEventStore;
use Prooph\Link\Application\Model\ConfigWriter;
use Prooph\Link\Application\Model\EventStoreConfig;

/**
 * Class InitializeEventStoreHandler
 *
 * Triggers the initialization of the event store
 *
 * @package SystemConfig\Model\ProcessingConfig
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class InitializeEventStoreHandler extends SystemConfigChangesHandler
{
    /**
     * @param InitializeEventStore $command
     */
    public function handle(InitializeEventStore $command)
    {
        $esConfig = EventStoreConfig::initializeWithSqliteDb(
            $command->sqliteDbFile(),
            $command->eventStoreConfigLocation(),
            $this->configWriter
        );

        foreach ($esConfig->popRecordedEvents() as $recordedEvent) $this->eventBus->dispatch($recordedEvent);
    }
}
 