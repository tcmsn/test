<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$extKey = 'tc_base';

ExtensionManagementUtility::addStaticFile(
    $extKey,
    'Configuration/TypoScript/',
    'TC Base'
);