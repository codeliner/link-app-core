<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 07.12.14 - 22:48
 */

namespace Prooph\Link\Application;

/**
 * Class Definition
 *
 * @package SystemConfig
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class Definition
{
    /**
     * @return string
     */
    public static function getDataDir()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'data';
    }

    /**
     * @return string
     */
    public static function getSystemConfigDir()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'autoload';
    }

    /**
     * @return string
     */
    public static function getScriptsDir()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'scripts';
    }

    /**
     * @return string
     */
    public static function getEventStoreSqliteDbFile()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'sqlite' . DIRECTORY_SEPARATOR . 'eventstore.db';
    }
}
 