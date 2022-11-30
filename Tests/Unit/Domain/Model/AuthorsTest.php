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
 * Test case for class \RKW\RkwAuthors\Domain\Model\Authors.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 */
class AuthorsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \RKW\RkwAuthors\Domain\Model\Authors
	 */
	protected $subject = NULL;

	protected function setUp(): void {
		$this->subject = new \RKW\RkwAuthors\Domain\Model\Authors();
	}

	protected function tearDown(): void {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() {
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMiddleNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMiddleName()
		);
	}

	/**
	 * @test
	 */
	public function setMiddleNameForStringSetsMiddleName() {
		$this->subject->setMiddleName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'middleName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() {
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleAfterReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitleAfter()
		);
	}

	/**
	 * @test
	 */
	public function setTitleAfterForStringSetsTitleAfter() {
		$this->subject->setTitleAfter('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titleAfter',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleBeforeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitleBefore()
		);
	}

	/**
	 * @test
	 */
	public function setTitleBeforeForStringSetsTitleBefore() {
		$this->subject->setTitleBefore('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titleBefore',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStreet()
		);
	}

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet() {
		$this->subject->setStreet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'street',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCompanyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCompany()
		);
	}

	/**
	 * @test
	 */
	public function setCompanyForStringSetsCompany() {
		$this->subject->setCompany('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'company',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNumber()
		);
	}

	/**
	 * @test
	 */
	public function setNumberForStringSetsNumber() {
		$this->subject->setNumber('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'number',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() {
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFunctionTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFunctionTitle()
		);
	}

	/**
	 * @test
	 */
	public function setFunctionTitleForStringSetsFunctionTitle() {
		$this->subject->setFunctionTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'functionTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFunctionDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFunctionDescription()
		);
	}

	/**
	 * @test
	 */
	public function setFunctionDescriptionForStringSetsFunctionDescription() {
		$this->subject->setFunctionDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'functionDescription',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPhone()
		);
	}

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone() {
		$this->subject->setPhone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'phone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhone2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPhone2()
		);
	}

	/**
	 * @test
	 */
	public function setPhone2ForStringSetsPhone2() {
		$this->subject->setPhone2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'phone2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFaxReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFax()
		);
	}

	/**
	 * @test
	 */
	public function setFaxForStringSetsFax() {
		$this->subject->setFax('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'fax',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFacebookUrlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFacebookUrl()
		);
	}

	/**
	 * @test
	 */
	public function setFacebookUrlForStringSetsFacebookUrl() {
		$this->subject->setFacebookUrl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'facebookUrl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTwitterUrlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTwitterUrl()
		);
	}

	/**
	 * @test
	 */
	public function setTwitterUrlForStringSetsTwitterUrl() {
		$this->subject->setTwitterUrl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'twitterUrl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getXingUrlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getXingUrl()
		);
	}

	/**
	 * @test
	 */
	public function setXingUrlForStringSetsXingUrl() {
		$this->subject->setXingUrl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'xingUrl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInternalReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getInternal()
		);
	}

	/**
	 * @test
	 */
	public function setInternalForBooleanSetsInternal() {
		$this->subject->setInternal(true);

		$this->assertAttributeEquals(
			true,
			'internal',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}
}
