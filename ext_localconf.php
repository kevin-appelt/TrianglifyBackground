<?php

if ($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['loginBackgroundImage'] == '') {
    $loadTrianglifyBackground = false;
    $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
    if ($typo3Version->getMajorVersion() === 10 && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_BE)) {
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
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
    if ($typo3Version->getMajorVersion() === 11) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
            \K10\Trianglify\Hook\PageRendererRenderPreProcess::class . '->addRequireJsConfiguration';
    }
}
