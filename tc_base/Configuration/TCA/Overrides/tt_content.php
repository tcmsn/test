<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$table = 'tt_content';
$extKey = 'tc_base';
$pluginName = 'tcbase_plugin';
$labelPrefix = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

// Inherit the look and feel of the text element so that we have header and bodytext
$GLOBALS['TCA'][$table]['types'][$pluginName] = $GLOBALS['TCA'][$table]['types']['text'];

// Add content typeicon_classes
$GLOBALS['TCA'][$table]['ctrl']['typeicon_classes'] = array_merge(
    $GLOBALS['TCA'][$table]['ctrl']['typeicon_classes'],
    [$pluginName => 'extensions-' . $pluginName]
);

// Tell TYPO3 about this plugin
ExtensionUtility::registerPlugin(
    'TYPOCONSULT.' . $extKey,
    'Plugin',
    $labelPrefix . '.' . $pluginName . '.name',
    'extensions-' . $pluginName
);