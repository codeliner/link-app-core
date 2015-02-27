<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 02.01.15 - 17:12
 */

namespace Prooph\Link\Application\Event;

/**
 * Class ProcessingConfigFileWasRemoved
 *
 * @package SystemConfig\Event
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessingConfigFileWasRemoved extends SystemChanged
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
 