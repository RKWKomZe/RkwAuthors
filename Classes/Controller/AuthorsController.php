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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


/**
 * Class AuthorsController
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AuthorsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * authorsRepository
     *
     * @var \RKW\RkwAuthors\Domain\Repository\AuthorsRepository
     * @inject
     */
    protected $authorsRepository = null;

    /**
     * pagesRepository
     *
     * @var \RKW\RkwAuthors\Domain\Repository\PagesRepository
     * @inject
     */
    protected $pagesRepository = null;

    /**
     * departmentRepository
     *
     * @var \RKW\RkwBasics\Domain\Repository\DepartmentRepository
     * @inject
     */
    protected $departmentRepository = null;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        // get authors list
        $authors = $this->authorsRepository->findAllSortByLastName();

        // get department list (for filter)
        $departmentList = $this->departmentRepository->findAllByVisibility();

        $this->view->assign('showPid', $this->settings['showPid']);
        $this->view->assign('authors', $authors);
        $this->view->assign('departmentList', $departmentList);
    }


    /**
     * action show
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @ignorevalidation $author
     * @return void
     */
    public function showAction(\RKW\RkwAuthors\Domain\Model\Authors $author)
    {
        $this->view->assign('author', $author);
        $this->view->assign('listPid', $this->settings['listPid']);
    }


    /**
     * action headline
     *
     * @return void
     */
    public function headlineAction()
    {
        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_rkwauthors_rkwauthorsdetail');
        $author = null;
        if ($getParams['author']) {
            $author = $this->authorsRepository->findByIdentifier(filter_var($getParams['author'], FILTER_SANITIZE_NUMBER_INT));
        }

        $this->view->assign('author', $author);
        $this->view->assign('listPid', $this->settings['listPid']);

    }


    /**
     * action showWork
     *
     * @return void
     */
    public function showWorkAction()
    {
        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_rkwauthors_rkwauthorsdetail');
        $author = null;
        if ($getParams['author']) {
            $author = $this->authorsRepository->findByIdentifier(filter_var($getParams['author'], FILTER_SANITIZE_NUMBER_INT));
        }

        $this->view->assign('author', $author);
        $this->view->assign('listPid', $this->settings['listPid']);
    }


    /**
     * Shows all authors of a page as boxes
     *
     * @return void
     */
    public function pageBoxAction()
    {
        // get PageRepository and rootline
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $rootlinePages = $repository->getRootLine(intval($GLOBALS['TSFE']->id));

        // fo through all pages and take the one that has a match in the corresponsing field
        $pid = intval($GLOBALS['TSFE']->id);
        foreach ($rootlinePages as $page => $values) {
            if (
                ($values['tx_rkwauthors_authorship'] > 0)
                && ($pid)
            ) {
                $pid = intval($values['uid']);
                break;
                //===
            }
        }

        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            $this->view->assign('page', $result);
            $this->view->assign('showPid', $this->settings['showPid']);
        }

    }


    /**
     * Shows only the first author of a page as detail-box
     *
     * @return void
     */
    public function pageBoxSmallFirstAction()
    {
        // get PageRepository and rootline
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $rootlinePages = $repository->getRootLine(intval($GLOBALS['TSFE']->id));

        // fo through all pages and take the one that has a match in the corresponsing field
        $pid = intval($GLOBALS['TSFE']->id);
        foreach ($rootlinePages as $page => $values) {
            if (
                ($values['tx_rkwauthors_authorship'] > 0)
                && ($pid)
            ) {
                $pid = intval($values['uid']);
                break;
                //===
            }
        }

        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            if ($result->getTxRkwauthorsAuthorship() instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
                $resultAsArray = $result->getTxRkwauthorsAuthorship()->toArray();
                $this->view->assign('author', $resultAsArray[0]);
                $this->view->assign('showPid', $this->settings['showPid']);
            }
        }
    }


    /**
     * Shows all but the first author of a page as detail-box
     *
     * @return void
     */
    public function pageBoxSmallRestAction()
    {
        // get PageRepository and rootline
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $rootlinePages = $repository->getRootLine(intval($GLOBALS['TSFE']->id));

        // fo through all pages and take the one that has a match in the corresponsing field
        $pid = intval($GLOBALS['TSFE']->id);
        foreach ($rootlinePages as $page => $values) {
            if (
                ($values['tx_rkwauthors_authorship'] > 0)
                && ($pid)
            ) {
                $pid = intval($values['uid']);
                break;
                //===
            }
        }

        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            if ($result->getTxRkwauthorsAuthorship() instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
                $resultAsArray = $result->getTxRkwauthorsAuthorship()->toArray();
                array_shift($resultAsArray);
                $this->view->assign('authors', $resultAsArray);
                $this->view->assign('showPid', $this->settings['showPid']);
            }
        }
    }


    /**
     * Lists all authors of a page
     *
     * @return void
     */
    public function pageSchemaOrgAction()
    {
        // get PageRepository and rootline
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $rootlinePages = $repository->getRootLine(intval($GLOBALS['TSFE']->id));

        // fo through all pages and take the one that has a match in the corresponsing field
        $pid = intval($GLOBALS['TSFE']->id);
        foreach ($rootlinePages as $page => $values) {
            if (
                ($values['tx_rkwauthors_authorship'] > 0)
                && ($pid)
            ) {
                $pid = intval($values['uid']);
                break;
                //===
            }
        }

        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            $this->view->assign('page', $result);
        }

        $this->view->assign('baseUrl', $this->settings['baseUrlSchemaOrg']);
        $this->view->assign('showPid', $this->settings['showPid']);
    }


    /**
     * Lists all authors of a page as commaseparated list
     *
     * @return void
     */
    public function pageCommaListAction()
    {
        $this->pageSchemaOrgAction();
    }


    /**
     * Shows a flexform based contact box
     *
     * @return void
     */
    public function contactBoxAction()
    {
        $this->view->assign('author1', $this->authorsRepository->findByIdentifier(intval($this->settings['author1'])));
        $this->view->assign('author2', $this->authorsRepository->findByIdentifier(intval($this->settings['author2'])));
    }


    /**
     * action contactForm
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param bool $finished Set this flag to show success message instead the contact form
     * @ignorevalidation $author
     * @return void
     */
    public function contactFormAction(\RKW\RkwAuthors\Domain\Model\Authors $author, $finished = false)
    {
        $this->view->assign('author', $author);
        $this->view->assign('finished', $finished);
    }


    /**
     * action contactFormSend
     *
     * privacy hint: There are no persistent form or frontendUser: So we'll created NO privacy entry (would be senseless)
     *
     * @param array $contactForm
     * @validate $contactForm \RKW\RkwAuthors\Validation\Validator\ContactFormValidator
     * @return void
     */
    public function contactFormSendAction($contactForm)
    {
        /** @var \RKW\RkwAuthors\Domain\Model\Authors $author */
        $author = $this->authorsRepository->findByIdentifier((intval($contactForm['author'])));

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rkw_mailer')) {

            // send message author
            /** @var \RKW\RkwAuthors\Service\RkwMailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwAuthors\\Service\\RkwMailService');
            $mailService->contactFormAuthor($author, $contactForm);

            // send copy to user
            /** @var \RKW\RkwAuthors\Service\RkwMailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwAuthors\\Service\\RkwMailService');
            $mailService->contactFormUser($author, $contactForm);
        }

        // send back with finished flag
        $this->forward('contactForm', null, null, ['author' => $author, 'finished' => true]);
    }
}