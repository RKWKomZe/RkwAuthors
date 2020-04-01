<?php
defined('TYPO3_MODE') || die('Access denied.');

(function () {

    // Hint: for plugin and flexform settings show /rkw_authors/Configuration/TCA/Overrides/tt_content.php
    // Hint: "addStaticFile" is now part of /Overrides/sys_template.php

    // "addLLrefForTCAdescr" & "allowTableOnStandardPages" below should be placed here in ext_tables
    // -> https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ExtensionArchitecture/ConfigurationFiles/Index.html#id4

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

})();
