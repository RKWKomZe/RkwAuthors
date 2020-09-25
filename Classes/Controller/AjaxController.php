<?php
namespace RKW\RkwAuthors\Controller;
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
 * Class AjaxController
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @deprecated This controller is deprecated and will be removed soon. Do not use it any more.
 */
class AjaxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{


    /**
     * AjaxController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        \TYPO3\CMS\Core\Utility\GeneralUtility::deprecationLog(__CLASS__ . ' will be removed soon. Do not use it any more.');
    }

	/**
	 * authorsRepository
	 *
	 * @var \RKW\RkwAuthors\Domain\Repository\AuthorsRepository
	 * @inject
	 */
	protected $authorsRepository = NULL;


	/**
	 * filterAction
	 *
	 * @param \RKW\RkwAuthors\Domain\Model\Filter $filter
	 * @return string
	 */
	public function filterAction(\RKW\RkwAuthors\Domain\Model\Filter $filter) {

		$authors = $this->authorsRepository->findByFilterOptions($filter);

		// get JSON helper
		/** @var \RKW\RkwBasics\Helper\Json $jsonHelper */
		$jsonHelper = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwBasics\\Helper\\Json');

		// get new list
		$replacements = array (
			'authors' => $authors,
			'showPid' => intval($this->settings['showPid'])
		);

		$jsonHelper->setHtml(
			'expert-list',
			$replacements,
			'replace',
			'Ajax/List/Authors.html'
		);

		print (string) $jsonHelper;
		exit();
		//===

	}

}


