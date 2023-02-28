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
        // Add Rootline Fields
        //=================================================================
        $rootlineFields = &$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'];
        $newRootlineFields = 'tx_rkwauthors_authorship';
        $rootlineFields .= (empty($rootlineFields))? $newRootlineFields : ',' . $newRootlineFields;
    },
    $_EXTKEY
);


