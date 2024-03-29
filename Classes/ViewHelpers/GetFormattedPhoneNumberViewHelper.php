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

use RKW\RkwAuthors\Domain\Model\Authors;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Class GetFormattedPhoneNumberViewHelper
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @todo write tests
 */
class GetFormattedPhoneNumberViewHelper extends AbstractViewHelper
{

    use CompileWithContentArgumentAndRenderStatic;

    /**
     * Initialize arguments.
     *
     * @return void
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('author', Authors::class, 'The author-object', true);
        $this->registerArgument('phoneExtensionLength', 'int', 'The length of the phone number ending.', false, 4);
    }


    /**
     * Static rendering
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {

        /** @var \RKW\RkwEvents\Domain\Model\Authors $author */
        $author = $arguments['author'];

        /** @var int $phoneExtensionLength */
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
        }

        return $phone . $lastPart;
    }
}


