<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements;

class HeaderStyle
{

    protected $config;
    protected $indention;
    protected $items;
    protected $selector;

    public function __construct(array $definitions, $config, int $indention = 4)
    {
        $this->config = $config;
        $this->indention = $indention;
        $this->items = $definitions['items'];
        $this->selector = $definitions['selector'];
    }

    public function __toString()
    {
        return $this->create();
    }

    public function create()
    {
        $style = '';

        $style .= $this->selector . " {\n";
        $style .= $this->createContent();
        $style .= "}\n";

        return $style;
    }

    public function getIndentionString()
    {
        $string = '';

        for ($i = 0; $i < $this->indention; $i++) {
            $string .= ' ';
        }

        return $string;
    }

    protected function createContent()
    {
        $string = '';
        $indention = $this->getIndentionString();

        foreach ($this->items as $key => $item) {
            $string .= $indention . $key . ': ' . $this->config->get($item[0]) . $item[1] . ";\n";
        }

        return $string;
    }

}
