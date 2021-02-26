<?php
defined('TYPO3_MODE') || die('Access denied.');

//=================================================================
// Register Plugins
//=================================================================
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'RKW.RkwAuthors',
    'Rkwauthors',
    'RKW Authors - List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'RKW.RkwAuthors',
    'Rkwauthorsdetail',
    'RKW Authors - Detail'
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'RKW.RkwAuthors',
    'Rkwauthorsheadline',
    'RKW Authors - Headline'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'RKW.RkwAuthors',
    'Rkwauthorswork',
    'RKW Authors - Show Work'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'RKW.RkwAuthors',
    'Rkwauthorscontactbox',
    'RKW Authors - Call-To-Action'
);


//=================================================================
// Add Flexform
//=================================================================
$extKey = 'rkw_authors';
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));
$pluginName = strtolower('Rkwauthorscontactbox');
$pluginSignature = $extensionName.'_'.$pluginName;

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extKey . '/Configuration/FlexForms/ContactBox.xml'
);