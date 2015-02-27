<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 12/8/14 - 10:06 PM
 */
namespace Prooph\Link\Application\Service;
use Zend\Mvc\I18n\Translator;


/**
 * Interface TranslatorAwareController
 *
 * @package Application\Service
 * @author Alexander Miertsch <alexander.miertsch.extern@sixt.com>
 */
interface TranslatorAwareController
{
    /**
     * @param Translator $translator
     * @return void
     */
    public function setTranslator(Translator $translator);
} 