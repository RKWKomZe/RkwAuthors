<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        //=================================================================
        // Register Plugins
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthors',
            'RKW Authors - List'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthorsdetail',
            'RKW Authors - Detail'
        );


        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthorsheadline',
            'RKW Authors - Headline'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthorswork',
            'RKW Authors - Show Work'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthorscontactbox',
            'RKW Authors - Call-To-Action'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Rkwauthorscontactform',
            'RKW Authors - Kontaktformular'
        );

        //=================================================================
        // Add Tables
        //=================================================================
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            'tx_rkwauthors_domain_model_authors',
            'EXT:rkw_authors/Resources/Private/Language/locallang_csh_tx_rkwauthors_domain_model_authors.xlf'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
            'tx_rkwauthors_domain_model_authors'
        );


        //=================================================================
        // Add TypoScript
        //=================================================================
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            $extKey,
            'Configuration/TypoScript',
            'RKW Authors'
        );


        //=================================================================
        // Add Flexform
        //=================================================================
        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));
        $pluginName = strtolower('Rkwauthorscontactbox');
        $pluginSignature = $extensionName.'_'.$pluginName;

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:EXT:'.$extKey . '/Configuration/FlexForms/ContactBox.xml'
        );


    },
    $_EXTKEY
);
