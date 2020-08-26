<?php

namespace TYPOCONSULT\TcBase\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPOCONSULT\TcBase\Domain\Repository\ContentRepository;
use TYPOCONSULT\TcSys\Utility\VoilaUtility;

/**
 * Class Voila
 *
 * @package TYPOCONSULT\TcBase\Hooks
 */
class Voila
{
    protected const EXTENSION_KEY = 'tc_base';

    /**
     * @param array $params
     *
     * @return string
     */
    public function addAdditionalPreview(array $params): string
    {
        $preview = '';

        if ($params['element']->getCtype() == 'tcbase_plugin') {
            $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
            $contentRepository = $objectManager->get(ContentRepository::class);
            $element = $contentRepository->findByUidRaw($params['element']->getUid());

            if ($element) {
                if ($element->getBodytext()) {
                    $preview .= VoilaUtility::renderBodytext($element);
                }
            }
        }

        return $preview;
    }
}