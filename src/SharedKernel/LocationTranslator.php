<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 08.01.15 - 15:16
 */

namespace Prooph\Link\Application\SharedKernel;

/**
 * Class LocationTranslator
 *
 * @package Application\SharedKernel
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class LocationTranslator 
{
    /**
     * @var array
     */
    private $locations;

    public function __construct(array $locations)
    {
        array_walk($locations, function ($location) {
            if (!is_dir($location)) throw new \InvalidArgumentException(sprintf('Location %s is not a directory', $location));
            if (!is_readable($location)) throw new \InvalidArgumentException(sprintf('Location %s is not readable', $location));
            if (!is_writable($location)) throw new \InvalidArgumentException(sprintf('Location %s is not writable', $location));
        });

        $this->locations = $locations;
    }

    /**
     * @param $location
     * @return string|null
     */
    public function getPathFor($location) {
        if (! isset($this->locations[$location])) return null;

        return $this->locations[$location];
    }

    /**
     * @param $path
     * @return string|null
     */
    public function getLocationByPath($path)
    {
        $location = array_search($path, $this->locations);

        return $location ? : null;
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        return array_keys($this->locations);
    }
}
 