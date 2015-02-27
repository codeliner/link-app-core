<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 30.12.14 - 18:33
 */

use Prooph\Link\Application\Event;

use Prooph\Link\Application\Event\SystemChanged;

/**
 * Class ProcessConfigWasChanged
 *
 * @package SystemConfig\Event
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessConfigWasChanged extends SystemChanged
{
    /**
     * @param array $newProcessConfig
     * @param array $oldProcessConfig
     * @param  string $startMessage
     * @return ProcessConfigWasChanged
     */
    public static function to(array $newProcessConfig, array $oldProcessConfig, $startMessage)
    {
        return self::occur(['start_message' => $startMessage, 'new_config' => $newProcessConfig, 'old_config' => $oldProcessConfig]);
    }

    /**
     * @return string
     */
    public function startMessage()
    {
        return $this->payload['start_message'];
    }

    /**
     * @return array
     */
    public function newProcessConfig()
    {
        return $this->payload['new_config'];
    }

    /**
     * @return array
     */
    public function oldProcessConfig()
    {
        return $this->payload['old_config'];
    }
}
 