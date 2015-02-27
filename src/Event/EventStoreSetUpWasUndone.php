<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 02.01.15 - 17:20
 */

use Prooph\Link\Application\Event;

use Prooph\Link\Application\Event\SystemChanged;
use Prooph\Link\Application\SharedKernel\ConfigLocation;

/**
 * Class EventStoreSetUpWasUndone
 *
 * @package SystemConfig\Event
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class EventStoreSetUpWasUndone extends SystemChanged
{
    /**
     * @param string $fileName
     * @return static
     */
    public static function in($fileName)
    {
        return self::occur(['config_file' => $fileName]);
    }

    /**
     * @return string
     */
    public function configFile()
    {
        return $this->toPayloadReader()->stringValue('config_file');
    }
}
 