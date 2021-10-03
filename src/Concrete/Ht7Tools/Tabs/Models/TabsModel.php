<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models;

use Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;

class TabsModel
{

    use CanLoadByGetMethod;

    protected $markup;
    protected $tabs;

    public function __construct(array $data, array $markup = [])
    {
        $this->markup = $markup;
        $this->load(['tabs' => $data]);
    }

    /**
     *
     * @return  array                   Indexed array of indexed array of id,
     *                                  label and isSelected of each tabs.
     */
    public function getArrayForC5Helper()
    {
        $tabs = [];

        foreach ($this->getTabs() as $tab) {
            $tabs[] = $tab->getArrayForC5Helper();
        }

        return $tabs;
    }

    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     *
     * @return TabModel[]
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
    }

}
