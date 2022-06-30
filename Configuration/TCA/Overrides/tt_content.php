<?php
defined('TYPO3_MODE') || die('Access denied.');

$extKey = 'rkw_authors';

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

//=================================================================
// Add Flexform
//=================================================================
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));

// Rkwauthorscontactbox
$pluginName = strtolower('Rkwauthorscontactbox');
$pluginSignature = $extensionName.'_'.$pluginName;
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extKey . '/Configuration/FlexForms/ContactBox.xml'
);

// Rkwauthors
$pluginName = strtolower('Rkwauthors');
$pluginSignature = $extensionName.'_'.$pluginName;
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extKey . '/Configuration/FlexForms/List.xml'
);

/*
 *  Does not have a return pid yet. Maybe usable in future?
// Rkwauthorsdetail
$pluginName = strtolower('Rkwauthorsdetail');
$pluginSignature = $extensionName.'_'.$pluginName;
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extKey . '/Configuration/FlexForms/Detail.xml'
);
*/

// Rkwauthorsheadline
$pluginName = strtolower('Rkwauthorsheadline');
$pluginSignature = $extensionName.'_'.$pluginName;
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extKey . '/Configuration/FlexForms/Headline.xml'
);

