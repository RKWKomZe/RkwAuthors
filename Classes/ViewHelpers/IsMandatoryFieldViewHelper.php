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

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Class IsMandatoryFieldViewHelper
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class IsMandatoryFieldViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    use CompileWithContentArgumentAndRenderStatic;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('fieldName', 'string', 'The current field name.', true);
        $this->registerArgument('mandatoryFields', 'string', 'The comma-separated list of mandatory fields.', true);
    }

    /**
     * Static rendering
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return bool
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): bool {

        /** @var string $fieldName */
        $fieldName = $arguments['fieldNam'];

        /** @var string $mandatoryFields */
        $mandatoryFields = $arguments['mandatoryFields'];

        $mandatoryFieldsArray = array_map('trim', explode(',', $mandatoryFields));
        if (!in_array($fieldName, $mandatoryFieldsArray)) {
            return true;
        }

        return false;
    }


}
