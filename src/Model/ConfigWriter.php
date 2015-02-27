<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 07.12.14 - 21:59
 */

namespace Prooph\Link\Application\Model;

/**
 * Interface ConfigWriter
 *
 * @package SystemConfig\Model
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface ConfigWriter
{
    /**
     * @param array $config
     * @param string $path
     * @return void
     */
    public function writeNewConfigToDirectory(array $config, $path);

    /**
     * @param array $config
     * @param string $path
     * @return void
     */
    public function replaceConfigInDirectory(array $config, $path);
}
 