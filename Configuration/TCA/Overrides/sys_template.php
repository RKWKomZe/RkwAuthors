<?php
defined('TYPO3_MODE') || die('Access denied.');

$extKey = 'rkw_authors';

//=================================================================
// Add TypoScript
//=================================================================
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $extKey,
    'Configuration/TypoScript',
    'RKW Authors'
);