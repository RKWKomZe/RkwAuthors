<?php

namespace RKW\RkwAuthors\Validation\Validator;

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
 * Class ContactFormValidator
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ContactFormValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{

    /**
     * TypoScript Settings
     *
     * @var array
     */
    protected $settings = null;

    /**
     * validation
     *
     * @var array $contactForm
     * @return boolean
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    public function isValid($contactForm)
    {

   //    DebuggerUtility::var_dump($contactForm); exit;

        // initialize typoscript settings
        $this->getSettings();


        $isValid = true;

        // E-MAIL
        if (!$contactForm['email']) {
            $this->result->forProperty('email')->addError(
                new \TYPO3\CMS\Extbase\Error\Error(
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                        'tx_rkwauthors_validator.not_filled',
                        'rkw_authors',
                        array('email')
                    ), 1587566321
                )
            );
            $isValid = false;
        } else {
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            /** @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver $validatorResolver */
            $validatorResolver = $objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
            $conjunctionValidator = $validatorResolver->createValidator('Conjunction');
            $conjunctionValidator->addValidator($validatorResolver->createValidator('EmailAddress'));
            $result = $conjunctionValidator->validate(strval($contactForm['email']));

            if (count($result->getErrors())) {
                $this->result->forProperty('email')->addError(
                    new \TYPO3\CMS\Extbase\Error\Error(
                        $result->getFirstError()->getMessage() , 1449314603
                    )
                );
                $isValid = false;
            }
        }

        // MESSAGE
        if (!$contactForm['message']) {
            $this->result->forProperty('message')->addError(
                new \TYPO3\CMS\Extbase\Error\Error(
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                        'tx_rkwauthors_validator.not_filled',
                        'rkw_authors',
                        array(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                            'form.error.message', 'rkw_authors'
                        ))
                    ), 1587566333
                )
            );
            $isValid = false;
        }

        // TERMS
        if (!$contactForm['terms']) {
            $this->result->forProperty('terms')->addError(
                new \TYPO3\CMS\Extbase\Error\Error(
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                        'form.error.terms', 'rkw_authors'
                    ), 1587566588
                )
            );
            $isValid = false;
        }


        return $isValid;
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

}

