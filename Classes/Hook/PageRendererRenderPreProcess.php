<?php

declare(strict_types=1);

namespace K10\Trianglify\Hook;

use TYPO3\CMS\Core\Page\PageRenderer;

final class PageRendererRenderPreProcess
{
    public function addRequireJsConfiguration(array $params, PageRenderer $pageRenderer): void
    {
        if (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_BE) {
            $pageRenderer->addRequireJsConfiguration([
                'shim' => [
                    'trianglify' => ['exports' => 'trianglify']
                ],
                'paths' => [
                    'trianglify' => \TYPO3\CMS\Core\Utility\PathUtility::getAbsoluteWebPath(
                            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('trianglify',
                                'Resources/Public/JavaScript/')
                        ) . 'trianglify.bundle'
                ]
            ]);
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Trianglify/TrianglifyBackground');
        }
    }
}
