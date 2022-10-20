<?php
namespace RKW\RkwAuthors\Tests\Unit\Controller;
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
 * Test case for class RKW\RkwAuthors\Controller\AuthorsController.
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 */
class AuthorsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \RKW\RkwAuthors\Controller\AuthorsController
	 */
	protected $subject = NULL;

	protected function setUp(): void {
		$this->subject = $this->getMock('RKW\\RkwAuthors\\Controller\\AuthorsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown(): void {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllAuthorssFromRepositoryAndAssignsThemToView() {

		$allAuthorss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$authorsRepository = $this->getMock('RKW\\RkwAuthors\\Domain\\Repository\\AuthorsRepository', array('findAll'), array(), '', FALSE);
		$authorsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allAuthorss));
		$this->inject($this->subject, 'authorsRepository', $authorsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('authorss', $allAuthorss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenAuthorsToView() {
		$authors = new \RKW\RkwAuthors\Domain\Model\Authors();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('authors', $authors);

		$this->subject->showAction($authors);
	}
}
