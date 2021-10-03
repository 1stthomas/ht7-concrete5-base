<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Views;

use \Concrete\Package\Ht7C5Base\Ht7Tools\AbstractView;

class SimpleView extends AbstractView
{

    protected $items = [];

    public function render()
    {
        $html = '';

        $html .= $this->getOpeningForm();
        $html .= $this->getOpeningListContainer();

        foreach ($this->items as $item) {
            $html .= (string) $item;
        }

        $html .= $this->getClosingListContainer();
        $html .= $this->getClosingForm();

        return $html;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

}
