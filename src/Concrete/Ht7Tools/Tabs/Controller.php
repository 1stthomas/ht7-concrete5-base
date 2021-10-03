<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs;

use \Concrete\Package\Ht7C5Base\Ht7Tools\AbstractToolController;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Printable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\TabFactory;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\View;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;

class Controller extends AbstractToolController
{

    /**
     * @var array               Assoc array of ids as keys and printables as values.
     */
    protected $content;

    /**
     * @var DefinitionTypable
     */
    protected $definitions;

    public function __construct(DefinitionTypable $definitions)
    {
        // ns atm: ht7_tabs.settings
        parent::__construct();

        $this->content = [];
        $this->definitions = $definitions;
        $this->factoryClass = TabFactory::class;
    }

    public function addTabContent(string $id, Printable $printable)
    {
        $this->content[$id] = $printable;
    }

    public function getTabIds()
    {
        $configTabs = $this->definitions->getConfigByKey('tabs');
        $nsTabs = $this->definitions->getNamespaceByKey('tabs');

        return $this->getFactory()
                        ->createTabIdArray($configTabs->get($nsTabs, []));
    }

    protected function setupView()
    {
        $this->view = new View();

        $configTabs = $this->definitions->getConfigByKey('tabs');
        $nsTabs = $this->definitions->getNamespaceByKey('tabs');

        $tabsModel = $this->getFactory()
                ->createTabsModel($configTabs->get($nsTabs, []), $this->content);

        $tabsArr = $this->getFactory()->replaceContent($tabsModel->getTabs(), $this->content);
        $tabsModel->setTabs($tabsArr);

        $this->view->setTabs($tabsModel)
                ->setFormUrl($this->definitions->get('urls')['form_save']);
    }

}
