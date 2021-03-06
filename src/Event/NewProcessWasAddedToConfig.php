<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 12/14/14 - 11:23 PM
 */
namespace Prooph\Link\Application\Event;

/**
 * Class NewProcessWasAddedToConfig
 *
 * @package SystemConfig\Event
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class NewProcessWasAddedToConfig extends SystemChanged
{
    public static function withDefinition($startMessage, array $processConfig)
    {
        return self::occur(["start_message" => $startMessage, "process_config" => $processConfig]);
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
    public function processConfig()
    {
        return $this->payload['process_config'];
    }
} 