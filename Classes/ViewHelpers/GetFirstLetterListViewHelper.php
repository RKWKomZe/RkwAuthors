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
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Class GetFirstLetterListViewHelper
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GetFirstLetterListViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{

    use CompileWithRenderStatic;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('author', Authors::class, 'The list of author-objects from which the list is to be built.', true);
        $this->registerArgument('prepend', 'string', 'String to prepend each letter.', false, '');
    }


    /**
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
        $authors = $arguments['authors'];
        $prepend = $arguments['prepend'];

        // go through authors and get all relevant first letters of last-names
        /** @var \RKW\RkwAuthors\Domain\Model\Authors $author */
        $relevantLetters = array();
        foreach ($authors as $author) {
            $firstLetter = strtolower(substr($author->getLastName(), 0, 1));
            if (!$relevantLetters[$firstLetter]) {
                $relevantLetters[$firstLetter] = $prepend . ' ' . strtoupper($firstLetter);
            }
        }
        asort($relevantLetters);

        return $relevantLetters;
    }
}
