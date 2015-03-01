<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 1/27/15 - 8:08 PM
 */
namespace Prooph\Link\Application\SharedKernel;

/**
 * Class ApplicationDataTypeLocation
 *
 * This class describes the location for application wide data types.
 * These types are synchronized with all processing nodes so that the
 * types are available on every node. Connectors should put their
 * types under the namespace Prooph\Link\Application\DataType\<ConnectorModule>\*
 * and write them to the appropriate directory mapping the namespace and
 * starting in the directory described by this location.
 *
 * @package Application\SharedKernel
 * @author Alexander Miertsch <alexander.miertsch.extern@sixt.com>
 */
final class ApplicationDataTypeLocation extends AbstractLocation
{
    /**
     * Writes the given class content to a class file named after the class.
     * The root directory is defined by the path of ApplicationDataTypeLocation.
     * The namespace of the class should start with Application\DataType\
     * If more sub namespaces are defined, the method creates a directory for each
     * namespace part if not already exists.
     *
     * By default a new class is only generated if it does not exist already.
     * You can force an override by setting the replace flag to true.
     *
     * @param $dataTypeFQCN
     * @param $classContent
     * @param bool $replace
     * @throws \InvalidArgumentException
     */
    public function addDataTypeClass($dataTypeFQCN, $classContent, $replace = false)
    {
        if (strpos($dataTypeFQCN, "Prooph\\Link\\Application\\DataType\\") !== 0) {
            throw new \InvalidArgumentException("Namespace of data type should start with Prooph\\Link\\Application\\DataType\\. Got " . $dataTypeFQCN);
        }
        $nsDirs = explode("\\", str_replace("Prooph\\Link\\Application\\DataType\\", "", $dataTypeFQCN));

        $className = array_pop($nsDirs);

        if (empty($className)) {
            throw new \InvalidArgumentException("Provided data type FQCN contains no class name: " . $dataTypeFQCN);
        }

        $currentPath = $this->toString();

        if (! empty($nsDirs)) {
            foreach ($nsDirs as $nsDir) {
                $currentPath .= DIRECTORY_SEPARATOR . $nsDir;
                if (! is_dir($currentPath)) mkdir($currentPath);
            }
        }

        $filename = $currentPath . DIRECTORY_SEPARATOR . $className . ".php";

        if (!$replace && file_exists($filename)) return;

        file_put_contents($filename, $classContent);
    }

    protected function additionalAssertPath($path)
    {
        if (!is_writable($path)) throw new \InvalidArgumentException(sprintf('Application data type location %s should be writable', $path));
    }
}