<?php

namespace RKW\RkwAuthors\ViewHelpers;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use \TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use \TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * Class GetFormattedPhoneNumberViewHelper
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GetFormattedPhoneNumberViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * Build a full phone number
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param integer $phoneExtensionLength
     * @return string
     */
    public function render(\RKW\RkwAuthors\Domain\Model\Authors $author, $phoneExtensionLength = 4)
    {

        return static::renderStatic(
            array(
                'author'               => $author,
                'phoneExtensionLength' => $phoneExtensionLength,
            ),
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
        //===
    }


    /**
     * Static rendering
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $author = $arguments['author'];
        $phoneExtensionLength = $arguments['phoneExtensionLength'];

        // cleanup and split into 3-digit strings
        $areaCode = preg_replace('/[^0-9]+/', '', $author->getPhone());
        $phone = preg_replace('/[^0-9]+/', '', $author->getPhone2());

        // last entry should have 4 digits
        $lastPart = '';
        if ($phone > 4) {
            if ($phoneExtensionLength > 0) {
                $lastPart = '-' . substr($phone, (-1 * intval($phoneExtensionLength)), intval($phoneExtensionLength));
            }
            $phone = substr($phone, 0, strlen($phone) - intval($phoneExtensionLength));
        }

        // merge together
        if ($areaCode) {
            return $areaCode . ' ' . $phone . $lastPart;
            //===
        }


        return $phone . $lastPart;
        //===
    }
}