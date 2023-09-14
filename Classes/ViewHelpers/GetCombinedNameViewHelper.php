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
 * Class GetCombinedNameViewHelper
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @todo write tests
 */
class GetCombinedNameViewHelper extends AbstractViewHelper
{

    use CompileWithContentArgumentAndRenderStatic;

    /**
     * Output is escaped already. We must not escape children, to avoid double encoding.
     *
     * @var bool
     */
    protected $escapeChildren = false;

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
        $this->registerArgument('addTitleBefore', 'bool', 'Adds the titles that belong before the name', false, true);
        $this->registerArgument('addTitleAfter', 'bool', 'Adds the titles that belong after the name', false, false);
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

        /** @var bool $addTitleBefore */
        $addTitleBefore = $arguments['addTitleBefore'];

        /** @var bool $addTitleAfter */
        $addTitleAfter = $arguments['addTitleAfter'];

        $name = '';
        if ($author instanceof \RKW\RkwAuthors\Domain\Model\Authors) {
            $name = $author->getLastName() ?: $author->getLastname();

            if ($author->getMiddleName()) {
                $name = $author->getMiddlename() . ' ' . $name;
            }

            if ($author->getFirstName()) {
                $name = $author->getFirstName() . ' ' . $name;
            }

            if ($addTitleBefore) {
                if ($author->getTitleBefore()) {
                    $name = $author->getTitleBefore() . ' ' . $name;
                }
            }

            if ($addTitleAfter) {
                if ($author->getTitleAfter()) {
                    $name .= ', ' . $author->getTitleAfter();
                }
            }
        }

        return $name;
    }
}


