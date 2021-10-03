<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings;

use \Concrete\Package\Ht7C5Base\Ht7Tools\AbstractToolController;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\SettingsFactory;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Views\SimpleView;

class Controller extends AbstractToolController
{

    /**
     * @var DefinitionTypable
     */
    protected $definitions;
    protected $tabId;

    public function __construct(DefinitionTypable $definitions, string $tabId = '')
    {
        parent::__construct();

        $this->definitions = $definitions;
        $this->tabId = $tabId;

        $this->factoryClass = SettingsFactory::class;
    }

    public function __toString()
    {
        if (empty($this->view)) {
            $this->setupView();

            $printables = $this->getFactory()->createPrintables(
                    $this->definitions,
                    (empty($this->tabId) ? [] : ['tabId' => $this->tabId])
            );

            $this->view->setItems($printables);

            if (empty($this->tabId)) {
                $urls = $this->definitions->get('urls');
                $this->view->setFormUrl($urls['form_save']);
            }
        }

        return $this->view->render();
    }

    protected function setupView()
    {
        $this->view = new SimpleView();
    }

}
