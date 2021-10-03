<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Renderable;

abstract class AbstractView implements Renderable
{

    /**
     * @var string
     */
    protected $formAttributes;

    public function __construct()
    {
        $this->formAttributes = [];
    }

    public function setFormUrl(string $url)
    {
        $this->formAttributes['url'] = $url;

        return $this;
    }

    protected function getClosingForm()
    {
        return empty($this->formAttributes['url']) ? '' : '</form>';
    }

    protected function getClosingListContainer()
    {
        return empty($this->formAttributes['url']) ? '' : '</ul>';
    }

    protected function getOpeningForm()
    {
        if (empty($this->formAttributes['url'])) {
            return '';
        }

        $class = empty($this->formAttributes['class']) ? 'settings-form' : $this->formAttributes['class'];
        $method = empty($this->formAttributes['method']) ? 'post' : $this->formAttributes['method'];

        return '<form action="' . $this->formAttributes['url'] . '" '
                . 'class="' . $class . '" method="' . $method . '">';
    }

    protected function getOpeningListContainer()
    {
        return empty($this->formAttributes['url']) ? '' : '<ul class="ht7-settings-list">';
    }

}
