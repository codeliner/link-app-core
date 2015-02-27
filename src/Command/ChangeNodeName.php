<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 12/8/14 - 7:23 PM
 */
namespace Prooph\Link\Application\Command;

use Prooph\Link\Application\SharedKernel\ConfigLocation;
use Prooph\Processing\Processor\NodeName;

/**
 * Command ChangeNodeName
 *
 * @package SystemConfig\Command
 * @author Alexander Miertsch <alexander.miertsch.extern@sixt.com>
 */
final class ChangeNodeName extends SystemCommand
{
    /**
     * @param NodeName $newNodeName
     * @param ConfigLocation $configLocation
     * @return ChangeNodeName
     */
    public static function to(NodeName $newNodeName, ConfigLocation $configLocation)
    {
        return new self(__CLASS__, ['node_name' => $newNodeName->toString(), 'config_location'  => $configLocation->toString()]);
    }

    /**
     * @return NodeName
     */
    public function newNodeName()
    {
        return NodeName::fromString($this->payload['node_name']);
    }

    /**
     * @return ConfigLocation
     */
    public function configLocation()
    {
        return ConfigLocation::fromPath($this->payload['config_location']);
    }

    /**
     * @param null|array $aPayload
     * @throws \InvalidArgumentException
     */
    protected function assertPayload($aPayload = null)
    {
        if (! is_array($aPayload) || ! array_key_exists('node_name', $aPayload) || ! array_key_exists('config_location', $aPayload)) {
            throw new \InvalidArgumentException('Payload does not contain a node_name or config_location');
        }

        if (! is_string($aPayload['node_name'])) throw new \InvalidArgumentException('Node name must be string');
        if (! is_string($aPayload['config_location'])) throw new \InvalidArgumentException('Config location must be string');
    }
}