<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TC Base',
    'description' => 'This is the base extension',
    'category' => 'misc',
    'author' => 'Claus Harup',
    'author_email' => 'ch@typoconsult.dk',
    'author_company' => 'TypoConsult A/S',
    'state' => 'excludeFromUpdates',
    'uploadfolder' => '',
    'createDirs' => '',
    'clearCacheOnLoad' => true,
    'version' => '9.0.2',
    'constraints' => [
        'depends' => [
            'extbase' => '9.5.14',
            'fluid' => '9.5.14',
            'typo3' => '9.5.14-9.99.99',
            'tc_sys' => '9.0.0-9.99.99'
        ]
    ]
];