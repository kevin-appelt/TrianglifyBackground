<?php

declare(strict_types=1);

namespace K10\Trianglify\Hook;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Page\PageRenderer;

final class PageRendererRenderPreProcess
{
    public function addRequireJsConfiguration(array $params, PageRenderer $pageRenderer): void
    {
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($params, 'test');
        if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface
            && ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()
        ) {
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Trianglify/TrianglifyBackground');
        }
    }
}
