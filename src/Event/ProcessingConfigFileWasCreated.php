<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 09.12.14 - 19:43
 */

use Prooph\Link\Application\Event;

use Prooph\Link\Application\Event\SystemChanged;
use Prooph\Link\Application\SharedKernel\ConfigLocation;

/**
 * Event ProcessingConfigFileWasCreated
 *
 * @package SystemConfig\Event
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessingConfigFileWasCreated extends SystemChanged
{
    /**
     * @param ConfigLocation $configLocation
     * @param string $fileName
     * @return static
     */
    public static function in(ConfigLocation $configLocation, $fileName)
    {
        return self::occur(['config_file' => $configLocation->toString() . DIRECTORY_SEPARATOR . $fileName]);
    }

    /**
     * @return string
     */
    public function configFile()
    {
        return $this->toPayloadReader()->stringValue('config_file');
    }
}
 