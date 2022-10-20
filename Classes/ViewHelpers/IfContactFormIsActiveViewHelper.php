<?php

namespace RKW\RkwAuthors\ViewHelpers;

use RKW\RkwAuthors\Domain\Model\Authors;
use RKW\RkwBasics\Utility\GeneralUtility as Common;
use RKW\RkwBasics\Utility\GeneralUtility;
use TYPO3\CMS\Core\Log\LogManager;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

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
class IfContactFormIsActiveViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{

    use CompileWithRenderStatic;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('author', Authors::class, 'The author-object for which the contact-form is to be displayed.', true);
    }


    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {

        $author = $arguments['author'];
        $settings = GeneralUtility::getTyposcriptConfiguration('Rkwauthors');

        //  if pageUid for contactForm is set
        if ($settings['contactForm']['pageUid']) {

            // Warning: Log if function is activated, but not usable
            if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rkw_mailer')) {
                self::getLogger()->log(
                    \TYPO3\CMS\Core\Log\LogLevel::WARNING,
                    'The optional contact form function of the rkw_authors extension is only available, if also the additional extension rkw_mailer is activated.'
                );
                return false;
            }

            // Error: If we have no authors email address AND no fallback
            if (
                !$author->getEmail()
                && !$settings['contactForm']['mail']['fallback']['address']
            ) {
                self::getLogger()->log(
                    \TYPO3\CMS\Core\Log\LogLevel::ERROR,
                    sprintf('The contact form is activated, but the author with UID %s has either an email address nor a fallback is defined.', $author->getUid())
                );
                return false;
            }

            // if nothing happens: show link to contact form
            return true;
        }

        // do not show link to contact form
        return false;
    }

    /**
     * Returns logger instance
     *
     * @return \TYPO3\CMS\Core\Log\Logger
     */
    protected static function getLogger()
    {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
    }
}
