<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_department',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY pid, name ASC',

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'searchFields' => 'first_name,middle_name,last_name,title_after,title_before,street,company,number,city,zip,function_title,function_description,email,phone,phone2,fax,facebook_url,twitter_url,xing_url,internal,show_work,image_boxes_is_logo,image_boxes,image_big,image_small,department,',
		'iconfile' => 'EXT:rkw_authors/Resources/Public/Icons/tx_rkwauthors_domain_model_authors.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_langufunctiage_uid, l10n_parent, l10n_diffsource, hidden, name, description',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, description'],
	],
	'palettes' => [ ],
	'columns' => [

		'sys_language_uid' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
					['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
				],
                'default' => 0
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 0,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_rkwauthors_domain_model_authors',
				'foreign_table_where' => 'AND tx_rkwauthors_domain_model_authors.pid=###CURRENT_PID### AND tx_rkwauthors_domain_model_authors.sys_language_uid IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],

		'hidden' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],

		'name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_department.name',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,required'
			],
		],
		'description' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_department.description',
			'config' => [
				'type' => 'text',
				'rows' => 5,
				'eval' => 'trim'
			],
		],
	]
];
