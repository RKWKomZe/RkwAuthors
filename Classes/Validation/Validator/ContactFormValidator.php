<?php

namespace RKW\RkwAuthors\Validation\Validator;

use SJBR\SrFreecap\Validation\Validator\CaptchaValidator;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \RKW\RkwBasics\Helper\Common;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Error\Error;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
        // initialize typoscript settings
        $settings = $this->getSettings();

        $mandatoryFieldsArray = GeneralUtility::trimExplode(',', $settings['contactForm']['mandatoryFields'], TRUE);

        $isValid = true;

        // iterate given form fields
        foreach ($contactForm as $key => $formField) {
            // check if field is mandatory (set via TS)
            if (in_array($key, $mandatoryFieldsArray)) {

                // if empty: throw error
                if (
                    (
                        ($key == 'salutation')
                        && ($formField == 99)
                    )
                    || (
                        ($key != 'salutation')
                        && (! $formField)
                    )
                ) {


                    $this->result->forProperty($key)->addError(
                        new Error(
                            LocalizationUtility::translate(
                                'tx_rkwauthors_validator.not_filled',
                                'rkw_authors',
                                array(LocalizationUtility::translate(
                                    'form.error.' . $key, 'rkw_authors'
                                ))
                            ), 1587566321
                        )
                    );
                    $isValid = false;
                }
            }
        }

        // E-MAIL (if filled -> looks valid?)
        if ($contactForm['email']) {
            $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            /** @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver $validatorResolver */
            $validatorResolver = $objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
            $conjunctionValidator = $validatorResolver->createValidator('Conjunction');
            $conjunctionValidator->addValidator($validatorResolver->createValidator('EmailAddress'));
            $result = $conjunctionValidator->validate(strval($contactForm['email']));

            if (count($result->getErrors())) {
                $this->result->forProperty('email')->addError(
                    new Error(
                        $result->getFirstError()->getMessage() .'.'
                        , 1449314603
                    )
                );
                $isValid = false;
            }
        }

        // TERMS (check only, if terms pid is set via TS)
        if ($settings['contactForm']['termsPid']) {
            if (!$contactForm['terms']) {
                $this->result->forProperty('terms')->addError(
                    new Error(
                        LocalizationUtility::translate(
                            'form.error.terms', 'rkw_authors'
                        ), 1587566588
                    )
                );
                $isValid = false;
            }
        }

        // PRIVACY (check only, if privacy pid is set via TS)
        if ($settings['contactForm']['privacyPid']) {
            if (!$contactForm['privacy']) {
                $this->result->forProperty('privacy')->addError(
                    new Error(
                        LocalizationUtility::translate(
                            'form.error.privacy', 'rkw_authors'
                        ), 1588941914
                    )
                );
                $isValid = false;
            }
        }

        // CAPTCHA
        // do not check if key exists, to avoid validation issue on manipulated forms.
        // -> Means: If sr_freecap is activated, it must also be part of the form. Otherwise, we will DIE here while using $contactForm['captchaResponse'] ....
        if (
            ExtensionManagementUtility::isLoaded('sr_freecap')
            && $settings['contactForm']['captcha']
        ) {

            $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
            $captchaValidator = $objectManager->get(CaptchaValidator::class);

            if ($captchaValidator->validate($contactForm['captchaResponse'])->hasErrors()) {
                $this->result->forProperty('captchaResponse')->addError(
                    new Error(
                        LocalizationUtility::translate(
                            '9221561048',
                            'srfreecap'
                        ), 1670643884
                    )
                );
                $isValid = false;
            }
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

