<?php

namespace RKW\RkwAuthors\Domain\Model;

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
 * Class Filter
 * This class dont have any repository. Just to handle ajax-filter-form the best way
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Filter extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * department
     *
     * @var integer
     */
    protected $department = 0;

    /**
     * letter
     *
     * @var string
     */
    protected $letter = '';


    /**
     * Returns the department
     *
     * @return integer $department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Sets the department
     *
     * @param integer $department
     * @return void
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * Returns the letter
     *
     * @return string $letter
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Sets the letter
     *
     * @param string $letter
     * @return void
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
    }

}
