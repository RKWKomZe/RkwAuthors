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
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;


/**
 * Class GetCombinedNameViewHelper
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GetCombinedNameViewHelper extends AbstractViewHelper
{

    use CompileWithRenderStatic;

    /**
     * Output is escaped already. We must not escape children, to avoid double encoding.
     *
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('author', Authors::class, 'The author-object from which the name is to be extracted.', true);
        $this->registerArgument('addTitleBefore', 'bool', 'Add the titles that precede the name.', false, true);
        $this->registerArgument('addTitleAfter', 'bool', 'Add the titles that come after the name.', false, false);
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
        $author = $arguments['author'];
        $addTitleBefore = $arguments['addTitleBefore'];
        $addTitleAfter = $arguments['addTitleAfter '];

        $name = '';
        if ($author instanceof \RKW\RkwAuthors\Domain\Model\Authors) {
            $name = $author->getLastname();

            if ($author->getMiddleName()) {
                $name = $author->getMiddlename() . ' ' . $name;
            }

            if ($author->getFirstName()) {
                $name = $author->getFirstname() . ' ' . $name;
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



