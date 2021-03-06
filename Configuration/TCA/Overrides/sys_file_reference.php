<?php
/**
* Image Crop-Defaults
*
*  'ratios' => [
*      '1.7777777777777777' => 'LLL:EXT:lang/locallang_wizards.xlf:imwizard.ratio.16_9',
*      '1.3333333333333333' => 'LLL:EXT:lang/locallang_wizards.xlf:imwizard.ratio.4_3',
*      '1' => 'LLL:EXT:lang/locallang_wizards.xlf:imwizard.ratio.1_1',
*      'NaN' => 'LLL:EXT:lang/locallang_wizards.xlf:imwizard.ratio.free',
*   )
*/

$currentVersion = TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version);
if ($currentVersion < 8000000) {

    $GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config'] = [
        'type'   => 'imageManipulation',
        'ratios' => array_merge(
            $GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['ratios'],
            [
                '0.787401575' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:sys_file_reference.ratio.list_image',
            ]
        )
    ];
}