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
 * Class Pages
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Pages extends \RKW\RkwBasics\Domain\Model\Pages
{

    /**
     * txRkwauthorsAuthorship
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors>
     */
    protected $txRkwauthorsAuthorship = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->txRkwauthorsAuthorship = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Authors
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $txRkwauthorsAuthorship
     * @return void
     */
    public function addTxRkwauthorsAuthorship(\RKW\RkwAuthors\Domain\Model\Authors $txRkwauthorsAuthorship)
    {
        $this->txRkwauthorsAuthorship->attach($txRkwauthorsAuthorship);
    }

    /**
     * Removes a Authors
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $txRkwauthorsAuthorshipToRemove The Authors to be removed
     * @return void
     */
    public function removeTxRkwauthorsAuthorship(\RKW\RkwAuthors\Domain\Model\Authors $txRkwauthorsAuthorshipToRemove)
    {
        $this->txRkwauthorsAuthorship->detach($txRkwauthorsAuthorshipToRemove);
    }

    /**
     * Returns the txRkwauthorsAuthorship
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors> $txRkwauthorsAuthorship
     */
    public function getTxRkwauthorsAuthorship()
    {
        return $this->txRkwauthorsAuthorship;
    }

    /**
     * Sets the txRkwauthorsAuthorship
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors> $txRkwauthorsAuthorship
     * @return void
     */
    public function setTxRkwauthorsAuthorship(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $txRkwauthorsAuthorship)
    {
        $this->txRkwauthorsAuthorship = $txRkwauthorsAuthorship;
    }

}