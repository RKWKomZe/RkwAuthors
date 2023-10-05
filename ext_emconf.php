<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "rkw_authors"
 *
 * Auto generated by Extension Builder 2014-08-11
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'RKW Authors',
	'description' => 'Extension for handling authorship of pages',
	'category' => 'plugin',
	'author' => 'Maximilian Fäßler, Steffen Kroggel',
	'author_email' => 'maximilian@faesslerweb.de, developer@steffenkroggel.de',
    'author_company' => 'RKW Kompetenzzentrum',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '9.5.6',
	'constraints' => [
		'depends' => [
            'typo3' => '9.5.0-10.4.99',
            'core_extended' => '9.5.4-10.4.99',
            'accelerator' => '9.5.2-10.4.99',
            'ajax_api' => '9.5.0-10.4.99',
            'fe_register' => '9.5.0-10.4.99',
		],
		'conflicts' => [
		],
		'suggests' => [
            'sr_freecap' => '2.5.0-2.5.99'
        ],
	],
];
