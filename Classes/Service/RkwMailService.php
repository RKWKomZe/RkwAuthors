<?php

namespace RKW\RkwAuthors\Service;

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

use Madj2k\CoreExtended\Utility\GeneralUtility as Common;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * RkwMailService
 *
 * @author Carlos Meyer <cm@davitec.de>
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class RkwMailService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * Handles contactForm mail for user
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $contactForm
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
    public function contactFormUser(\RKW\RkwAuthors\Domain\Model\Authors $author, $contactForm)
    {
        // send contact form copy
        $this->userMail(
            $author,
            [
                'email' => $contactForm['email']
            ],
            $contactForm,
            'contactForm'
        );

    }


    /**
     * Handles confirm mail for author
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $contactForm
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
    public function contactFormAuthor(\RKW\RkwAuthors\Domain\Model\Authors $author, $contactForm)
    {
        $this->authorMail(
            $author,
            [
                'email' => $contactForm['email']
            ],
            $contactForm,
            'contactForm'
        );
    }


    /**
     * Sends an E-Mail to a Frontend-User
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $frontendUser
     * @param array $contactForm
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
    protected function userMail(\RKW\RkwAuthors\Domain\Model\Authors $author, $frontendUser, $contactForm, $action)
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
                    'author' => $author,
                    'contactForm'  => $contactForm,
                    'language' => strval($GLOBALS['TSFE']->config['config']['language'])
                ),
            ));

            // Reply Address: Set author OR fallback mail OR override mail
            if (
                ($settingsDefault['contactForm']['mail']['override']['address'] && $settingsDefault['contactForm']['mail']['override']['name'])
                || $settingsDefault['contactForm']['mail']['fallback']['address']
                || $author->getEmail()
            ) {
                if ($settingsDefault['contactForm']['mail']['override']['address'] && $settingsDefault['contactForm']['mail']['override']['name']) {
                    // if set: use override email first
                    $mailService->getQueueMail()->setReplyAddress(strval($settingsDefault['contactForm']['mail']['override']['address']));
                    $mailService->getQueueMail()->setFromName(strval($settingsDefault['contactForm']['mail']['override']['name']));
                } else {
                    // author or fallback email
                    $mailService->getQueueMail()->setReplyAddress($author->getEmail() ? $author->getEmail() : strval($settingsDefault['contactForm']['mail']['fallback']['address']));
                    $mailService->getQueueMail()->setFromName($author->getFirstName() . ' ' . $author->getLastName());
                }

            } else {
                // Log: No valid email set
                $this->getLogger()->log(\TYPO3\CMS\Core\Log\LogLevel::ERROR, sprintf('No valid email is for author with UID %s is defined. Also no fallback or override!', $author->getUid()));
            }

            $mailService->getQueueMail()->setSubject(
                \RKW\RkwMailer\Utility\FrontendLocalizationUtility ::translate(
                    'rkwMailService.' . strtolower($action) . 'User.subject',
                    'rkw_authors',
                    null,
                    strval($GLOBALS['TSFE']->config['config']['language'])
                )
            );

            $mailService->getQueueMail()->addTemplatePaths($settings['view']['templateRootPaths']);
            $mailService->getQueueMail()->addPartialPaths($settings['view']['partialRootPaths']);

            $mailService->getQueueMail()->setPlaintextTemplate('Email/' . ucfirst(strtolower($action)) . 'User');
            $mailService->getQueueMail()->setHtmlTemplate('Email/' . ucfirst(strtolower($action)) . 'User');

            $mailService->send();
        }
    }


    /**
     * Sends an E-Mail to an Author
     *
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @param array $frontendUser
     * @param array $contactForm
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
    protected function authorMail(\RKW\RkwAuthors\Domain\Model\Authors $author, $frontendUser, $contactForm, $action)
    {
        // get settings
        $settings = $this->getSettings(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $settingsDefault = $this->getSettings();

        if ($settings['view']['templateRootPaths']) {

            /** @var \RKW\RkwMailer\Service\MailService $mailService */
            $mailService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RKW\\RkwMailer\\Service\\MailService');

            $emailTo = '';
            $lastName = $author->getLastName();
            $firstName = $author->getFirstName();
            // Reply Address: Set author OR fallback mail OR override mail
            if (
                ($settingsDefault['contactForm']['mail']['override']['address'] && $settingsDefault['contactForm']['mail']['override']['name'])
                || $settingsDefault['contactForm']['mail']['fallback']['address']
                || $author->getEmail()
            ) {
                if ($settingsDefault['contactForm']['mail']['override']['address'] && $settingsDefault['contactForm']['mail']['override']['name']) {
                    // if set: use override email first
                    $emailTo = strval($settingsDefault['contactForm']['mail']['override']['address']);
                    // @toDo: Should we have firstName & lastName vor override-Email in TS?
                    // -> if yes: Don't forget to edit also function "userMail"
                    $firstName = '';
                    $lastName = strval($settingsDefault['contactForm']['mail']['override']['name']);
                } else {
                    // author or fallback email
                    $emailTo = $author->getEmail() ? $author->getEmail() : strval($settingsDefault['contactForm']['mail']['fallback']['address']);
                }

            } else {
                // Log: No valid email set
                $this->getLogger()->log(\TYPO3\CMS\Core\Log\LogLevel::ERROR, sprintf('No valid email is for author with UID %s is defined. Also no fallback or override!', $author->getUid()));
            }

            if (
                $author instanceof \RKW\RkwAuthors\Domain\Model\Authors
                && ($emailTo)
            ) {
                // send new user an email with token
                $mailService->setTo(
                    [
                        'email' => $emailTo,
                        'firstName' => $firstName,
                        'lastName' => $lastName
                    ]
                    , array(
                    'marker'  => array(
                        'author' => $author,
                        'contactForm' => $contactForm,
                        'language' => $settingsDefault['contactForm']['mail']['language']
                    )
                ));
            }

            $mailService->getQueueMail()->setReplyAddress(strval($frontendUser['email']));

            if ($emailTo != $author->getEmail()) {
                // by override or fallback: "contact request for xyz"
                $mailService->getQueueMail()->setSubject(
                    \RKW\RkwMailer\Utility\FrontendLocalizationUtility ::translate(
                        'rkwMailService.' . strtolower($action) . 'Author.subjectFor',
                        'rkw_authors',
                        null,
                        $settingsDefault['contactForm']['mail']['language']
                    ) . ' ' . $author->getFirstName() . ' ' . $author->getLastName() . ' ' . $author->getEmail()
                );
            } else {
                // to author directly: Just wrote "contact request by (user-email)" to subject
                // Just an idea below: Set the email of the user to the subject for better distinction of many mails
                $mailService->getQueueMail()->setSubject(
                    \RKW\RkwMailer\Utility\FrontendLocalizationUtility ::translate(
                        'rkwMailService.' . strtolower($action) . 'Author.subjectBy',
                        'rkw_authors',
                        null,
                        $settingsDefault['contactForm']['mail']['language']
                    ) . ' ' . strval($frontendUser['email'])
                );
            }

            $mailService->getQueueMail()->addTemplatePaths($settings['view']['templateRootPaths']);
            $mailService->getQueueMail()->addPartialPaths($settings['view']['partialRootPaths']);

            $mailService->getQueueMail()->setPlaintextTemplate('Email/' . ucfirst(strtolower($action)) . 'Author');
            $mailService->getQueueMail()->setHtmlTemplate('Email/' . ucfirst(strtolower($action)) . 'Author');

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
        return Common::getTypoScriptConfiguration('Rkwauthors', $which);
    }


    /**
     * Returns logger instance
     *
     * @return \TYPO3\CMS\Core\Log\Logger
     */
    protected function getLogger()
    {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
    }
}
