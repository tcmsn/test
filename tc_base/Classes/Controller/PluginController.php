<?php

namespace TYPOCONSULT\TcBase\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPOCONSULT\TcBase\Domain\Repository\ContentRepository;
use TYPOCONSULT\TcSys\Utility\CommonUtility;
use TYPOCONSULT\TcSys\Utility\PageresourceUtility;
use TYPOCONSULT\TcSys\Utility\SassCompilerUtility;

/**
 * Class PluginController
 *
 * @package TYPOCONSULT\TcBase\Controller
 */
class PluginController extends ActionController
{
    /**
     * @var ContentRepository
     */
    protected ContentRepository $contentRepository;

    /**
     * @var array
     */
    public array $cObjData;

    /**
     * @param ContentRepository $contentRepository
     */
    public function injectContentRepository(ContentRepository $contentRepository): void
    {
        $this->contentRepository = $contentRepository;
    }

    public function initializeAction(): void
    {
        // @extensionScannerIgnoreLine
        $this->cObjData = $this->configurationManager->getContentObject()->data;
    }

    /**
     * @throws \Exception
     */
    public function showAction(): void
    {
        $content = $this->contentRepository->findByUid($this->cObjData['uid']);

        if ($content) {
            $this->view->assign('content', $content);

            $this->styleBlock();
            $this->scriptBlock();
        }
    }

    private function styleBlock(): void
    {
        if (isset($this->settings['stylesPaths']) && is_array($this->settings['stylesPaths'])) {
            $styleSheet = '';

            foreach ($this->settings['stylesPaths'] as $key => $path) {
                $styleSheet .= SassCompilerUtility::process($path);
            }

            PageresourceUtility::addStyleBlock(
                CommonUtility::getUniqueNumberFromString($this->extensionName),
                $styleSheet
            );
        }
    }

    /**
     * @throws \Exception
     */
    private function scriptBlock(): void
    {
        if (isset($this->settings['javascriptPaths']) && is_array($this->settings['javascriptPaths'])) {
            $javaScript = '';

            foreach ($this->settings['javascriptPaths'] as $key => $path) {
                $javaScript .= @file_get_contents(CommonUtility::getPath($path));
            }

            $search = [
                '###tabletMinWidth###',
                '###tabletMaxWidth###'
            ];

            $replace = [
                intval($this->settings['tabletMinWidth']),
                intval($this->settings['tabletMaxWidth'])
            ];

            PageresourceUtility::addScriptBlock(
                CommonUtility::getUniqueNumberFromString($this->extensionName),
                str_replace($search, $replace, $javaScript)
            );
        }
    }
}