<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {
        //=================================================================
        // Configure Plugins
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.' . $extKey,
            'Main',
            array(
                'Authors' => 'list, pageBox, pageSchemaOrg, pageCommaList',
            ),
            // non-cacheable actions
            array(
                'Authors' => '',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.' . $extKey,
            'Details',
            array(
                'Authors' => 'show, contactFormSend',

            ),
            // non-cacheable actions
            array(
                'Authors' => 'show, contactFormSend',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.' . $extKey,
            'Headline',
            array(
                'Authors' => 'headline',
            ),
            // non-cacheable actions
            array(
                'Authors' => 'headline',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.' . $extKey,
            'Contact',
            array(
                'Authors' => 'contactBox',
            ),
            // non-cacheable actions
            array(
                'Authors' => 'contactBox',
            )
        );

        //=================================================================
        // Add XClasses for extending existing classes
        //=================================================================

        if (class_exists(\RKW\RkwShop\Domain\Model\Author::class)) {
            // for TYPO3 12+
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\RKW\RkwAuthors\Domain\Model\Authors::class] = [
                'className' => \RKW\RkwShop\Domain\Model\Author::class
            ];

            // for TYPO3 9.5 - 11.5 only, not required for TYPO3 12
            \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
                ->registerImplementation(
                    \RKW\RkwAuthors\Domain\Model\Authors::class,
                    \RKW\RkwShop\Domain\Model\Author::class
                );
        }

        //=================================================================
        // Add Rootline Fields
        //=================================================================
        $rootlineFields = &$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'];
        $newRootlineFields = 'tx_rkwauthors_authorship';
        $rootlineFields .= (empty($rootlineFields))? $newRootlineFields : ',' . $newRootlineFields;
    },
    'rkw_authors'
);


