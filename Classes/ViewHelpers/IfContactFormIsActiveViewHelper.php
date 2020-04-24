<?php

namespace RKW\RkwAuthors\ViewHelpers;

use \RKW\RkwBasics\Helper\Common;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
 * Class IfContactFormIsActiveViewHelper
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class IfContactFormIsActiveViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param \RKW\RkwAuthors\Domain\Model\Authors $author
     * @return bool
     */
    public function render(\RKW\RkwAuthors\Domain\Model\Authors $author)
    {
        $settings = $this->getSettings();

        //  if pageUid for contactForm is set
        if ($settings['contactForm']['pageUid']) {

            // Warning: Log if function is activated, but not usable
            if (
                !\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rkw_mailer')
            ) {
                $this->getLogger()->log(\TYPO3\CMS\Core\Log\LogLevel::WARNING, sprintf('The optional contact form function of the rkw_authors extension is only available, if also the additional extension rkw_mailer are activated.'));
                return false;
                //===
            }

            // Error: If we have no authors email address AND no fallback
            if (
                !$author->getEmail()
                && !$settings['contactForm']['mail']['fallback']['address']
            ) {
                $this->getLogger()->log(\TYPO3\CMS\Core\Log\LogLevel::ERROR, sprintf('The contact form is activated, but the author with UID %s has either an email address nor a fallback is defined.', $author->getUid()));
                return false;
                //===
            }

            // if nothing happen: show link to contact form
            return true;
            //===
        }

        // do not show link to contact form
        return false;
        //===
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
        return Common::getTyposcriptConfiguration('Rkwauthors', $which);
        //===
    }

    /**
     * Returns logger instance
     *
     * @return \TYPO3\CMS\Core\Log\Logger
     */
    protected function getLogger()
    {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
        //===
    }
}