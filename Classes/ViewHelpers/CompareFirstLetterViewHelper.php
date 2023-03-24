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
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Class CompareFirstLetterViewHelper
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @todo write tests
 */
class CompareFirstLetterViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
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
        $this->registerArgument('authorList', QueryResultInterface::class, 'List of author-objects', true);
        $this->registerArgument('iter', 'int', 'The iteration-variable.', true);
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

        /** @var \RKW\RkwAuthors\Domain\Model\Authors $author */
        $author = $arguments['author'];

        /** @var \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $authorList */
        $authorList = $arguments['authorList'];

        /** @var int $iter */
        $iter = $arguments['iter'];

        // 1. first iteration: always print letter
        if ($iter == 0) {
            return true;
        }

        // Get the author who was printed before the actual one
        /** @var \RKW\RkwAuthors\Domain\Model\Authors $authorBefore */
        $authorBefore = $authorList[$iter - 1];

        // 2. if: the author before hasn't the same starting letter -> return true -> print letter!
        if (substr($author->getLastName(), 0, 1) !== substr($authorBefore->getLastName(), 0, 1)) {
            return true;
        }

        // 3. else: return false -> print nothing!
        return false;
    }
}
