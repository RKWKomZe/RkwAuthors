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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class News
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class News extends \GeorgRinger\News\Domain\Model\News
{

    /**
     * txRkwauthorsAuthorship
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors>|null
     */
    protected ?ObjectStorage $txRkwauthorsAuthorship = null;


    /**
     * __construct
     */
    public function __construct()
    {
        // Do not remove the next line: It would break the functionality
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
    public function addTxRkwauthorsAuthorship(Authors $txRkwauthorsAuthorship): void
    {
        $this->txRkwauthorsAuthorship->attach($txRkwauthorsAuthorship);
    }


    /**
     * Removes a Authors
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $txRkwauthorsAuthorshipToRemove The Authors to be removed
     * @return void
     */
    public function removeTxRkwauthorsAuthorship(Authors $txRkwauthorsAuthorshipToRemove): void
    {
        $this->txRkwauthorsAuthorship->detach($txRkwauthorsAuthorshipToRemove);
    }


    /**
     * Returns the txRkwauthorsAuthorship
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors> $txRkwauthorsAuthorship
     */
    public function getTxRkwauthorsAuthorship(): ObjectStorage
    {
        return $this->txRkwauthorsAuthorship;
    }


    /**
     * Sets the txRkwauthorsAuthorship
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwAuthors\Domain\Model\Authors> $txRkwauthorsAuthorship
     * @return void
     */
    public function setTxRkwauthorsAuthorship(ObjectStorage $txRkwauthorsAuthorship): void
    {
        $this->txRkwauthorsAuthorship = $txRkwauthorsAuthorship;
    }

}
