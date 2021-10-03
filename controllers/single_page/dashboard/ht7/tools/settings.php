<?php

namespace Concrete\Package\Ht7C5Base\Controller\SinglePage\Dashboard\Ht7\Tools;

use \Concrete\Core\Page\Page;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Controllers\AbstractHt7ToolsSettings;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements\PageDefinitions;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\PageDefinitionTypes;

defined('C5_EXECUTE') or die('Access Denied.');

class Settings extends AbstractHt7ToolsSettings
{

    public function __construct(Page $c)
    {
        parent::__construct($c);

        /* @var $pkgH \Concrete\Package\Ht7C5Base\Services\PackageBase */
        $pkgH = $this->app->make('helper/ht7/package/base');
        $pkgFileConfig = $pkgH->getPackageFileConfig($this);
        $pkgHandle = $pkgH->getPackageHandle($this);

        $this->definitions = new PageDefinitions(
                [
            'definitions' => ['forms.settings', $pkgFileConfig],
            'elements' => [
                'label' => ['tools/settings/label', $pkgHandle],
                'setting' => ['tools/settings/attributes', $pkgHandle]
            ],
            'tabs' => ['ht7_tabs.settings', $pkgFileConfig],
            'urls' => [
                'form_abort' => $this->action(),
                'form_save' => $this->action('save'),
            ],
            'values' => ['settings', $pkgFileConfig],
                ],
                PageDefinitionTypes::SIMPLE
        );
    }

}
