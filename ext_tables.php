<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Rkwauthors',
	'RKW Authors - List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Rkwauthorsdetail',
	'RKW Authors - Detail'
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Rkwauthorsheadline',
	'RKW Authors - Headline'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Rkwauthorswork',
	'RKW Authors - Show Work'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Rkwauthorscontactbox',
	'RKW Authors - Call-To-Action'
);

//=================================================================
// Add Tables
//=================================================================
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_rkwauthors_domain_model_authors', 'EXT:rkw_authors/Resources/Private/Language/locallang_csh_tx_rkwauthors_domain_model_authors.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_rkwauthors_domain_model_authors');

//=================================================================
// Add TypoScript
//=================================================================
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'RKW Authors');

//=================================================================
// Add Flexform
//=================================================================
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Rkwauthorscontactbox');
$pluginSignature = $extensionName.'_'.$pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/ContactBox.xml');

