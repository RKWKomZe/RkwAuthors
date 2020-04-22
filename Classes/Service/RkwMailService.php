<?php

namespace RKW\RkwAuthors\Service;

use \RKW\RkwBasics\Helper\Common;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use RKW\RkwEvents\Helper\DivUtility;

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
 * RkwMailService
 *
 * @author Carlos Meyer <cm@davitec.de>
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwEvents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class RkwMailService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * Handles confirm mail for user
     * Works with RkwRegistration-FrontendUser -> this is correct! (data comes from TxRkwRegistration)
     *
     * @param \RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser
     * @param \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation
     * @return void
     * @throws \RKW\RkwMailer\Service\MailException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotReturnException
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    public function confirmReservationUser(\RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser, \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation)
    {
        // send confirmation
        $this->userMail($frontendUser, $eventReservation, 'confirmation', true);

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rkw_survey')) {
            // send additional mail for survey (is some "surveyBefore" ist set in event)
            if ($eventReservation->getEvent()->getSurveyBefore()) {
                $this->userMail($frontendUser, $eventReservation, 'survey');
            }
        }
    }


    /**
     * Handles confirm mail for admin
     *
     * @param \RKW\RkwEvents\Domain\Model\BackendUser|array $backendUser
     * @param \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation
     * @return void
     * @throws \RKW\RkwMailer\Service\MailException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotReturnException
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    public function confirmReservationAdmin($backendUser, \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation)
    {
        $this->adminMail($backendUser, $eventReservation, 'confirmation');
    }


    /**
     * Sends an E-Mail to a Frontend-User
     *
     * @param \RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser
     * @param \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation
     * @param boolean $sendCalendarMeeting
     * @param string $action
     * @throws \RKW\RkwMailer\Service\MailException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotReturnException
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    protected function userMail(\RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser, \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation, $action = 'confirmation', $sendCalendarMeeting = false)
    {
        // get settings
        $settings = $this->getSettings(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $settingsDefault = $this->getSettings();

        if ($settings['view']['templateRootPaths']) {

            /** @var \RKW\RkwMailer\Service\MailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwMailer\\Service\\MailService');

            // send new user an email with token
            $mailService->setTo($frontendUser, array(
                'marker' => array(
                    'reservation'  => $eventReservation,
                    'frontendUser' => $frontendUser,
                    'pageUid'      => intval($GLOBALS['TSFE']->id),
                    'loginPid'     => intval($settingsDefault['loginPid']),
                    'showPid'      => intval($settingsDefault['showPid']),
                    'uniqueKey'    => uniqid(),
                    'currentTime'  => time(),
                    'surveyPid'    => intval($settingsDefault['surveyPid']),
                ),
            ));

            // set reply address
            if (count($eventReservation->getEvent()->getInternalContact()) > 0) {

                /** @var \RKW\RkwEvents\Domain\Model\Authors $contact */
                foreach ($eventReservation->getEvent()->getInternalContact() as $contact) {

                    if ($contact->getEmail()) {
                        $mailService->getQueueMail()->setReplyAddress($contact->getEmail());
                        break;
                        //===
                    }
                }
            }

            $mailService->getQueueMail()->setSubject(
                \RKW\RkwMailer\Helper\FrontendLocalization::translate(
                    'rkwMailService.' . strtolower($action) . 'ReservationUser.subject',
                    'rkw_events',
                    null,
                    $frontendUser->getTxRkwregistrationLanguageKey()
                )
            );

            $mailService->getQueueMail()->addTemplatePaths($settings['view']['templateRootPaths']);
            $mailService->getQueueMail()->addPartialPaths($settings['view']['partialRootPaths']);

            $mailService->getQueueMail()->setPlaintextTemplate('Email/' . ucfirst(strtolower($action)) . 'ReservationUser');
            $mailService->getQueueMail()->setHtmlTemplate('Email/' . ucfirst(strtolower($action)) . 'ReservationUser');

            // Attach calendar event if set
            if (
                ($sendCalendarMeeting)
                && ($settings['settings']['attachCalendarEvent'])
            ) {
                //$mailService->getQueueMail()->setCalendarTemplate($settings['view']['templateRootPaths'] . 'Email/' . ucfirst(strtolower($action)) . 'ReservationUser');
                $mailService->getQueueMail()->setCalendarTemplate('Email/' . ucfirst(strtolower($action)) . 'ReservationUser');
            }

            $mailService->send();
        }
    }


    /**
     * Sends an E-Mail to an Admin
     *
     * @param \RKW\RkwEvents\Domain\Model\BackendUser|array $backendUser
     * @param \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation
     * @param string $action
     * @param \RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser
     * @throws \RKW\RkwMailer\Service\MailException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotException
     * @throws \TYPO3\CMS\Extbase\SignalSlot\Exception\InvalidSlotReturnException
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    protected function adminMail($backendUser, \RKW\RkwEvents\Domain\Model\EventReservation $eventReservation, $action = 'confirmation', \RKW\RkwRegistration\Domain\Model\FrontendUser $frontendUser = null)
    {
        // get settings
        $settings = $this->getSettings(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $settingsDefault = $this->getSettings();

        $recipients = array();
        if (is_array($backendUser)) {
            $recipients = $backendUser;
        } else {
            $recipients[] = $backendUser;
        }

        if ($settings['view']['templateRootPaths']) {

            /** @var \RKW\RkwMailer\Service\MailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwMailer\\Service\\MailService');

            foreach ($recipients as $recipient) {

                if (
                    (
                        ($recipient instanceof \RKW\RkwEvents\Domain\Model\BackendUser)
                        || ($recipient instanceof \RKW\RkwEvents\Domain\Model\EventContact)
                    )
                    && ($recipient->getEmail())
                ) {

                    $language = $recipient->getLang();
                    if ($language instanceof \SJBR\StaticInfoTables\Domain\Model\Language) {
                        $language = $language->getTypo3Code();
                    }

                    $name = '';
                    if ($recipient instanceof \RKW\RkwEvents\Domain\Model\BackendUser) {
                        $name = $recipient->getRealName();
                    }
                    if ($recipient instanceof \RKW\RkwEvents\Domain\Model\EventContact) {
                        $name = $recipient->getFirstName() . ' ' . $recipient->getLastName();
                    }

                    // send new user an email with token
                    $mailService->setTo($recipient, array(
                        'marker'  => array(
                            'reservation'  => $eventReservation,
                            'admin'        => $recipient,
                            'frontendUser' => $frontendUser,
                            'pageUid'      => intval($GLOBALS['TSFE']->id),
                            'loginPid'     => intval($settingsDefault['loginPid']),
                            'showPid'      => intval($settingsDefault['showPid']),
                            'fullName'     => $name,
                            'language'     => $language,
                        ),
                        'subject' => \RKW\RkwMailer\Helper\FrontendLocalization::translate(
                            'rkwMailService.' . strtolower($action) . 'ReservationAdmin.subject',
                            'rkw_events',
                            null,
                            $recipient->getLang()
                        ),
                    ));
                }
            }

            if (
                ($eventReservation->getFeUser())
                && ($eventReservation->getFeUser()->getEmail())
            ) {
                $mailService->getQueueMail()->setReplyAddress($eventReservation->getFeUser()->getEmail());
            }

            $mailService->getQueueMail()->setSubject(
                \RKW\RkwMailer\Helper\FrontendLocalization::translate(
                    'rkwMailService.' . strtolower($action) . 'ReservationAdmin.subject',
                    'rkw_events',
                    null,
                    'de'
                )
            );

            $mailService->getQueueMail()->addTemplatePaths($settings['view']['templateRootPaths']);
            $mailService->getQueueMail()->addPartialPaths($settings['view']['partialRootPaths']);

            $mailService->getQueueMail()->setPlaintextTemplate('Email/' . ucfirst(strtolower($action)) . 'ReservationAdmin');
            $mailService->getQueueMail()->setHtmlTemplate('Email/' . ucfirst(strtolower($action)) . 'ReservationAdmin');

            if (count($mailService->getTo())) {
                $mailService->send();
            }
        }
    }


    /**
     * Returns TYPO3 settings
     *
     * @param string $which Which type of settings will be loaded
     * @return array
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    protected function getSettings($which = ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS)
    {
        return Common::getTyposcriptConfiguration('Rkwevents', $which);
        //===
    }
}
