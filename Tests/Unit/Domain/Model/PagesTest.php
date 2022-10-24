<?php

namespace RKW\RkwAuthors\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Steffen Kroggel <developer@steffenkroggel.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \RKW\RkwAuthors\Domain\Model\Pages.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 */
class PagesTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \RKW\RkwAuthors\Domain\Model\Pages
	 */
	protected $subject = NULL;

	protected function setUp(): void {
		$this->subject = new \RKW\RkwAuthors\Domain\Model\Pages();
	}

	protected function tearDown(): void {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTxRkwauthorsAuthorshipReturnsInitialValueForAuthors() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTxRkwauthorsAuthorship()
		);
	}

	/**
	 * @test
	 */
	public function setTxRkwauthorsAuthorshipForObjectStorageContainingAuthorsSetsTxRkwauthorsAuthorship() {
		$txRkwauthorsAuthorship = new \RKW\RkwAuthors\Domain\Model\Authors();
		$objectStorageHoldingExactlyOneTxRkwauthorsAuthorship = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTxRkwauthorsAuthorship->attach($txRkwauthorsAuthorship);
		$this->subject->setTxRkwauthorsAuthorship($objectStorageHoldingExactlyOneTxRkwauthorsAuthorship);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTxRkwauthorsAuthorship,
			'txRkwauthorsAuthorship',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTxRkwauthorsAuthorshipToObjectStorageHoldingTxRkwauthorsAuthorship() {
		$txRkwauthorsAuthorship = new \RKW\RkwAuthors\Domain\Model\Authors();
		$txRkwauthorsAuthorshipObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$txRkwauthorsAuthorshipObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($txRkwauthorsAuthorship));
		$this->inject($this->subject, 'txRkwauthorsAuthorship', $txRkwauthorsAuthorshipObjectStorageMock);

		$this->subject->addTxRkwauthorsAuthorship($txRkwauthorsAuthorship);
	}

	/**
	 * @test
	 */
	public function removeTxRkwauthorsAuthorshipFromObjectStorageHoldingTxRkwauthorsAuthorship() {
		$txRkwauthorsAuthorship = new \RKW\RkwAuthors\Domain\Model\Authors();
		$txRkwauthorsAuthorshipObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$txRkwauthorsAuthorshipObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($txRkwauthorsAuthorship));
		$this->inject($this->subject, 'txRkwauthorsAuthorship', $txRkwauthorsAuthorshipObjectStorageMock);

		$this->subject->removeTxRkwauthorsAuthorship($txRkwauthorsAuthorship);

	}
}
