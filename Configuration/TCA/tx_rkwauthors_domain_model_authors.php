<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors',
		'label' => 'last_name',
		'label_alt' => 'first_name',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY internal DESC, last_name ASC',

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'first_name, middle_name, last_name, title_before, title_after, street, company, number, city, zip, email, department, function_title, phone, phone2, fax, function_description, url, facebook_url, twitter_url, xing_url, internal, show_work, image_boxes, image_big, image_small,',
		'iconfile' => 'EXT:rkw_authors/Resources/Public/Icons/tx_rkwauthors_domain_model_authors.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_langufunctiage_uid, l10n_parent, l10n_diffsource, hidden, first_name, middle_name, last_name, title_before, title_after, street, company, number, city, zip, email, department, function_title, phone, phone2, fax, function_description, url, facebook_url, twitter_url, xing_url, internal, show_work, image_boxes, image_big, image_small',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, --palette--;;1, --palette--;LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.palettes.names;names, --palette--;LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.palettes.addition;addition, department, function_title, email, --palette--;LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.palettes.address;address, --palette--;LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.palettes.phones;phones, image_boxes, image_boxes_is_logo, image_big, image_small, function_description, url, facebook_url, twitter_url, xing_url, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
	],
	'palettes' => [
		'names' => [
            'showitem' => 'first_name, middle_name, last_name',
            'canNotCollapse' => 0
        ],
        'addition' => [
            'showitem' => 'title_after, title_before, internal, show_work',
            'canNotCollapse' => 0
        ],
        'address' => [
            'showitem' => 'company, street, number, --linebreak--, zip, city',
            'canNotCollapse' => 0
        ],
        'phones' => [
            'showitem' => 'phone, phone2, fax,',
            'canNotCollapse' => 0
        ]
    ],
	'columns' => [
	
		'sys_language_uid' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
					['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
				],
                'default' => 0
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 0,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
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
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],
		'starttime' => [
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				],
			],
		],
		'endtime' => [
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				],
			],
		],

		'first_name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.first_name',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,required'
			],
		],
		'middle_name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.middle_name',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'last_name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.last_name',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,required'
			],
		],
		'title_after' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.title_after',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'title_before' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.title_before',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'street' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.street',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'company' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.company',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'number' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.number',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'city' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.city',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'zip' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.zip',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],
		'function_title' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.function_title',
			'config' => [
				'type' => 'text',
                'rows' => 2,
				'eval' => 'trim'
			],
		],
		'function_title_short' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.function_title_short',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'function_description' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.function_description',
			'config' => [
				'type' => 'text',
				'rows' => 42,
			],
			'defaultExtras' => 'richtext[]:rte_transform[flag=rte_enabled|mode=ts_css]',
		],
		'email' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.email',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                    'mode' => 'wizard',
                            ]
                        ],
                        'JSopenParams' => 'height=400,width=550,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            // List of tabs to hide in link window. Allowed values are:
                            // file, mail, page, spec, folder, url
                            'blindLinkOptions' => 'url,file,page,spec,folder',

                            // allowed extensions for file
                            //'allowedExtensions' => 'mp3,ogg',
                        ]
                    ]
                ],
                'softref' => 'typolink'
			],
		],
		'phone' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.phone',
			'config' => [
				'type' => 'input',
				'size' => 6,
				'eval' => 'trim,num'
			],
		],
		'phone2' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.phone2',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,num'
			],
		],
		/*
		'fax' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.fax',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			],
		],*/

        'url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.url',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                'mode' => 'wizard',
                            ]
                        ],
                        'JSopenParams' => 'height=400,width=550,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            // List of tabs to hide in link window. Allowed values are:
                            // file, mail, page, spec, folder, url
                            'blindLinkOptions' => 'mail,file,page,spec,folder',

                            // allowed extensions for file
                            //'allowedExtensions' => 'mp3,ogg',
                        ]
                    ]
                ],
                'softref' => 'typolink'
            ],
        ],
        'facebook_url' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.facebook_url',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                'mode' => 'wizard',
                            ]
                        ],
                        'JSopenParams' => 'height=400,width=550,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            // List of tabs to hide in link window. Allowed values are:
                            // file, mail, page, spec, folder, url
                            'blindLinkOptions' => 'mail,file,page,spec,folder',

                            // allowed extensions for file
                            //'allowedExtensions' => 'mp3,ogg',
                        ]
                    ]
                ],
                'softref' => 'typolink'
			],
		],
		'twitter_url' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.twitter_url',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                'mode' => 'wizard',
                            ]
                        ],
                        'JSopenParams' => 'height=400,width=550,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            // List of tabs to hide in link window. Allowed values are:
                            // file, mail, page, spec, folder, url
                            'blindLinkOptions' => 'mail,file,page,spec,folder',

                            // allowed extensions for file
                            //'allowedExtensions' => 'mp3,ogg',
                        ]
                    ]
                ],
                'softref' => 'typolink'
			],
		],
		'xing_url' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.xing_url',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                'mode' => 'wizard',
                            ]
                        ],
                        'JSopenParams' => 'height=400,width=550,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            // List of tabs to hide in link window. Allowed values are:
                            // file, mail, page, spec, folder, url
                            'blindLinkOptions' => 'mail,file,page,spec,folder',

                            // allowed extensions for file
                            //'allowedExtensions' => 'mp3,ogg',
                        ]
                    ]
                ],
                'softref' => 'typolink'
			],
		],
		'internal' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.internal',
			'config' => [
				'type' => 'check',
				'default' => 0,
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.internal.I.enabled'
                    ]
                ]
			]
		],
		'show_work' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.show_work',
			'config' => [
				'type' => 'check',
				'default' => 0,
				'items' => [
					'1' => [
						'0' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.show_work.I.enabled'
					]
				]
			]
		],
        'image_boxes_is_logo' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.image_boxes_is_logo',
            'config' => [
                'type' => 'check',
                'default' => 0,
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.image_boxes_is_logo.I.enabled'
                    ]
                ]
            ]
        ],		
		'image_boxes' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.image_boxes',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image_boxes',
				 [
					'maxitems' => 1,

					// Use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => [
						'0' => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
							],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
						'	showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						]
					]
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
		],
		'image_big' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.image_big',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image_big',
				[
					'maxitems' => 1,

					// Use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => [
						'0' => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
							],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
						'	showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						]
					]
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
		],
		'image_small' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.image_small',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image_small',
 				[
					'maxitems' => 1,

					// Use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => [
						'0' => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
							],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
						'	showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						]
					]
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
		],

		'department' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_authors.department',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'size' => 1,
				'eval' => 'int',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => [
					['---', 0],
                ],
                'foreign_table' => 'tx_rkwauthors_domain_model_department',
                'foreign_table_where' => 'AND ((\'###PAGE_TSCONFIG_IDLIST###\' <> \'0\' AND FIND_IN_SET(tx_rkwauthors_domain_model_department.pid,\'###PAGE_TSCONFIG_IDLIST###\')) OR (\'###PAGE_TSCONFIG_IDLIST###\' = \'0\')) AND tx_rkwauthors_domain_model_department.deleted = 0 AND tx_rkwauthors_domain_model_department.hidden = 0',
			]
		]
	]
];
