<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 07.12.14 - 00:05
 */

namespace Prooph\Link\Application\Projection;

use Prooph\Link\Application\SharedKernel\ConfigLocation;
use Codeliner\ArrayReader\ArrayReader;

/**
 * Class ProcessingConfig
 *
 * @package ProcessConfig\Projection
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessingConfig
{
    /**
     * @var ArrayReader
     */
    private $config;

    /**
     * @var ConfigLocation
     */
    private $configLocation;

    /**
     * @var bool
     */
    private $configured = false;

    /**
     * @var array
     */
    private $availableTypes;

    /**
     * @param array $processingConfig
     * @param ConfigLocation $configLocation
     * @param bool $isConfigured
     */
    public function __construct(array $processingConfig, ConfigLocation $configLocation, $isConfigured = false)
    {
        $this->configured = $isConfigured;
        $this->configLocation = $configLocation;
        $this->config = new ArrayReader($processingConfig);
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return $this->configured;
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        return is_writable($this->configLocation->toString() . DIRECTORY_SEPARATOR . \Prooph\Link\Application\Model\ProcessingConfig::configFileName());
    }

    /**
     * @return string
     */
    public function getNodeName()
    {
        return $this->config->stringValue('processing.node_name');
    }

    /**
     * @return bool
     */
    public function isJavascriptTickerEnabled()
    {
        return $this->config->booleanValue('processing.js_ticker.enabled');
    }

    /**
     * @return int
     */
    public function getJavascriptTickerInterval()
    {
        return $this->config->integerValue('processing.js_ticker.interval', 3);
    }

    /**
     * @return bool
     */
    public function isWorkflowProcessorMessageQueueEnabled()
    {
        return ! empty($this->config->arrayValue(
            'processing.channels.'
            . \Prooph\Link\Application\Model\ProcessingConfig::WORKFLOW_PROCESSOR_MESSAGE_QUEUE_CHANNEL
        ));
    }

    /**
     * @return array
     */
    public function getProcessDefinitions()
    {
        return $this->config->arrayValue('processing.processes');
    }

    /**
     * @return array
     */
    public function getAllAvailableProcessingTypes()
    {
        if (! is_null($this->availableTypes)) return $this->availableTypes;

        $availableTypes = [];

        foreach ($this->config->arrayValue('processing.connectors') as $connectorConfig) {
            if (! is_array($connectorConfig)) continue;

            $typesDefinition = new ArrayReader($connectorConfig);

            foreach($typesDefinition->arrayValue('allowed_types') as $allowedType) {
                $availableTypes[] = $allowedType;
            }
        }

        //Reindex array
        $this->availableTypes = array_values(array_unique($availableTypes));

        return $this->availableTypes;
    }

    /**
     * @return array
     */
    public function getConnectors()
    {
        return $this->config->arrayValue('processing.connectors');
    }

    /**
     * @return ConfigLocation
     */
    public function getConfigLocation()
    {
        return $this->configLocation;
    }
}
 