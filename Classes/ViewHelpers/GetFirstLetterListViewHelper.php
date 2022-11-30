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

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Class GetFirstLetterListViewHelper
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GetFirstLetterListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
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
        $this->registerArgument('authors', QueryResultInterface::class, 'List of author-objects', true);
        $this->registerArgument('prepend', 'string', 'String to prepend.', false, '');
    }


    /**
     * Static rendering
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return array
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): array {

        /** @var \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $authors */
        $authors = $arguments['authors'];

        /** @var string $prepend */
        $prepend = $arguments['prepend'];

        // go through authors and get all relevant first letters of last-names
        /** @var \RKW\RkwAuthors\Domain\Model\Authors $author */
        $relevantLetters = array();
        foreach ($authors as $author) {
            $firstLetter = strtolower(substr($author->getLastName(), 0, 1));
            if (!$relevantLetters[$firstLetter]) {
                $relevantLetters[$firstLetter] = trim($prepend . ' ' . strtoupper($firstLetter));
            }
        }
        asort($relevantLetters);
        return $relevantLetters;
    }
}
