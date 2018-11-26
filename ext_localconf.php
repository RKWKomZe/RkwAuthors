<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Rkwauthors',
	array(
		'Authors' => 'list, pageBox, pageBoxSmallFirst, pageBoxSmallRest, pageSchemaOrg, pageCommaList',
		'Ajax' => 'filter'
		
	),
	// non-cacheable actions
	array(
		'Authors' => '',

		'Ajax' => ''
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Rkwauthorsdetail',
	array(
		'Authors' => 'show',

	),
	// non-cacheable actions
	array(
		'Authors' => 'show',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Rkwauthorsheadline',
	array(
		'Authors' => 'headline',

	),
	// non-cacheable actions
	array(
		'Authors' => 'headline',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Rkwauthorswork',
	array(
		'Authors' => 'showWork',

	),
	// non-cacheable actions
	array(
		'Authors' => 'showWork',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RKW.' . $_EXTKEY,
	'Rkwauthorscontactbox',
	array(
		'Authors' => 'contactBox',

	),
	// non-cacheable actions
	array(
		'Authors' => 'contactBox',
	)
);

// Add rootline-Fields
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_rkwauthors_authorship';

