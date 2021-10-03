<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements\HeaderStyle;

class HeaderItem
{

    protected $config;

    /**
     * @var array
     */
    protected $items;

    /**
     * @param   array   $items
     */
    public function __construct($config, array $items = [])
    {
        $this->config = $config;
        $this->items = $items;
    }

    public function __toString()
    {
        return $this->create();
    }

    /**
     * Create and get the HTML style element.
     *
     * @return  string              The HTML style element with the defined content.
     */
    public function create()
    {
        if (empty($this->items)) {
            return '';
        }

        $style = "<style>\n";
        foreach ($this->items as $item) {
            $style .= (string) (new HeaderStyle($item, $this->config));
        }
        $style .= "</style>\n";

        return $style;
    }

}
