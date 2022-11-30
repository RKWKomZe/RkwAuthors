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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\RootlineUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


/**
 * Class AuthorsController
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AuthorsController extends \RKW\RkwAjax\Controller\AjaxAbstractController
{

    /**
     * authorsRepository
     *
     * @var \RKW\RkwAuthors\Domain\Repository\AuthorsRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $authorsRepository = null;

    /**
     * pagesRepository
     *
     * @var \RKW\RkwAuthors\Domain\Repository\PagesRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $pagesRepository = null;

    /**
     * departmentRepository
     *
     * @var \RKW\RkwBasics\Domain\Repository\DepartmentRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $departmentRepository = null;


    /**
     * action list
     *
     * @param array $filter
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function listAction($filter = [])
    {

        // get authors list
        if ($filter) {
            $authors = $this->authorsRepository->findByFilterOptionsArray($filter);
        } else {
            $authors = $this->authorsRepository->findAllSortByLastName();
        }

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
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("author")
     * @return void
     */
    public function showAction(\RKW\RkwAuthors\Domain\Model\Authors $author)
    {
        $this->view->assign('author', $author);
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

    }


    /**
     * action showWork
     *
     * @return void
     * @deprecated This function is deprecated and will be removed soon
     */
    public function showWorkAction()
    {

        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);

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
        $pid = $this->getPidForAuthors();

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
     * @deprecated This function is deprecated and will be removed soon
     */
    public function pageBoxSmallFirstAction()
    {

        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);

        $pid = $this->getPidForAuthors();
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
     * @deprecated This function is deprecated and will be removed soon
     */
    public function pageBoxSmallRestAction()
    {

        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);

        $pid = $this->getPidForAuthors();
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
     * Lists all authors of a page with schema.org
     *
     * @return void
     */
    public function pageSchemaOrgAction()
    {
        $pid = $this->getPidForAuthors();
        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            $this->view->assign('page', $result);
        }

        $this->view->assign('baseUrl', $this->settings['baseUrlSchemaOrg']);
        $this->view->assign('showPid', $this->settings['showPid']);
    }


    /**
     * Lists all authors of a page as comma-separated list
     *
     * @return void
     */
    public function pageCommaListAction()
    {

        $pid = $this->getPidForAuthors();
        $result = $this->pagesRepository->findByUid($pid);
        if ($result instanceof \RKW\RkwAuthors\Domain\Model\Pages) {
            $this->view->assign('page', $result);
        }

    }


    /**
     * Shows a flexform based contact box
     *
     * @return void
     */
    public function contactBoxAction()
    {
        $this->view->assign('showPid', $this->settings['showPid']);
        $this->view->assign('author1', $this->authorsRepository->findByIdentifier(intval($this->settings['author1'])));
        $this->view->assign('author2', $this->authorsRepository->findByIdentifier(intval($this->settings['author2'])));
    }



    /**
     * action contactFormSend
     *
     * privacy hint: There are no persistent form or frontendUser: So we'll created NO privacy entry (would be senseless)
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $contactForm
     * @TYPO3\CMS\Extbase\Annotation\Validate("\RKW\RkwAuthors\Validation\Validator\ContactFormValidator", param="contactForm")
     * @return void
     * @throws \RKW\RkwMailer\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotReturnException
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function contactFormSendAction(\RKW\RkwAuthors\Domain\Model\Authors $author, $contactForm = [])
    {
        // above we have now set a default value to $contactForm for better URL handling. Through manually checking $contactForm
        // content we can avoid that empty requests without $contactForm-data leads to a crash:
        // Required argument "contactForm" is not set for RKW\RkwAuthors\Controller\AuthorsController->contactFormSend.
        if (empty($contactForm)) {
            // send back
            $this->redirect(
                'show',
                null,
                null,
                ['author' => $author ? $author : $contactForm['author']['__identity']]
            );
        }

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rkw_mailer')) {

            // send message author
            /** @var \RKW\RkwAuthors\Service\RkwMailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\RKW\RkwAuthors\Service\RkwMailService::class);
            $mailService->contactFormAuthor($author, $contactForm);

            // send copy to user (only if user has checked the checkbox)
            if ($contactForm['copyToUser']) {
                /** @var \RKW\RkwAuthors\Service\RkwMailService $mailService */
                $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\RKW\RkwAuthors\Service\RkwMailService::class);
                $mailService->contactFormUser($author, $contactForm);
            }
        }

        $this->addFlashMessage(
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                'authorsController.message.emailSent', 'rkw_authors'
            ),
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );

        // send back
        $this->redirect(
            'show',
            null,
            null,
            ['author' => $author ? $author : $contactForm['author']['__identity']]
        );
    }



    /**
     * Returns the page id of the authors list in the rootline recursively
     * @return int
     */
    protected function getPidForAuthors ()
    {

        if ($this->settings['recursiveAuthorList']) {

            $rootlinePages = GeneralUtility::makeInstance(RootlineUtility::class, intval($GLOBALS['TSFE']->id))->get();

            // fo through all pages and take the one that has a match in the corresponsing field
            $pid = intval($GLOBALS['TSFE']->id);
            foreach ($rootlinePages as $page => $values) {
                if (
                    ($values['tx_rkwauthors_authorship'] > 0)
                    && ($pid)
                ) {
                    $pid = intval($values['uid']);
                    break;
                }
            }
            return $pid;
        }

        return intval($GLOBALS['TSFE']->id);
    }


    /**
     * Remove ErrorFlashMessage
     *
     * @see \TYPO3\CMS\Extbase\Mvc\Controller\ActionController::getErrorFlashMessage()
     */
    protected function getErrorFlashMessage(): bool
    {
        return false;
    }
}
