<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$extKey = 'tc_base';

\TYPOCONSULT\TcSys\Utility\CommonUtility::loadIcons(
    $extKey,
    'Resources/Public/Icons/'
);