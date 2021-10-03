<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs;

use \Concrete\Core\Support\Facade\Application as ApplicationFacade;
use \Concrete\Package\Ht7C5Base\Ht7Tools\AbstractView;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Printable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models\TabsModel;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models\TabModel;

class View extends AbstractView
{

    /**
     * @var TabsModel
     */
    protected $tabs;

    public function render()
    {
        if (empty($this->tabs->getTabs())) {
            return;
        }

        $html = '';
        $app = ApplicationFacade::getFacadeApplication();

        $html .= $app->make('helper/concrete/ui')
                ->tabs($this->tabs->getArrayForC5Helper());

        $html .= $this->getOpeningForm();

        foreach ($this->tabs->getTabs() as $tab) {
            $html .= $this->getOpeningTabContent($tab);
            if ($tab->getContent() instanceof Printable) {
                $html .= (string) $tab->getContent();
            }
            $html .= $this->getEndingTabContent();
        }

        $html .= $this->getClosingForm();

        return $html;
    }

    public function setTabs(TabsModel $tabs)
    {
        $this->tabs = $tabs;

        return $this;
    }

    protected function getEndingTabContent()
    {
        return $this->getClosingListContainer() . '</' . $this->getTag() . '>';
    }

    protected function getOpeningTabContent(TabModel $tab)
    {
        return '<' . $this->getTag()
                . ' id="' . $this->getIdPrefix() . '-' . $tab->getId()
                . '" class="' . $this->getClass() . '">'
                . $this->getOpeningListContainer();
    }

    /**
     * @todo These 3 methods have to be done better!!!
     *
     * @return type
     */
    private function getClass()
    {
        return $this->tabs->getMarkup()['content']['container']['attributes']['class'];
    }

    private function getIdPrefix()
    {
        return $this->tabs->getMarkup()['content']['container']['attributes']['id'];
    }

    private function getTag()
    {
        return $this->tabs->getMarkup()['content']['container']['tag'];
    }

}
