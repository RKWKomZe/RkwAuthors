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

/**
 * Class CompareFirstLetterViewHelper
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CompareFirstLetterViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $authorList
     * @param int $iter
     * @return string
     */
    public function render(\RKW\RkwAuthors\Domain\Model\Authors $author, $authorList, $iter)
    {

        // 1. first iteration: always print letter
        if ($iter == 0) {
            return true;
            //===
        }


        // Get the author who was printed before the actual one
        /** @var \RKW\RkwAuthors\Domain\Model\Authors $authorBefore */
        $authorBefore = $authorList[$iter - 1];

        // 2. if: the author before hasn't the same starting letter -> return true -> print letter!
        if (substr($author->getLastName(), 0, 1) !== substr($authorBefore->getLastName(), 0, 1)) {
            return true;
            //===
        }

        // 3. else: return false -> print nothing!
        return false;
        //===
    }
}