<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Views;

use \Concrete\Core\View\View;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Printable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Renderable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AttributeModel;

class AttributeItemView implements Renderable, Printable
{

    protected $defsElements;
    protected $items = [];
    protected $model;

    public function __construct(AttributeModel $model, array $defsElements = [])
    {
        $this->defsElements = $defsElements;
        $this->model = $model;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function render()
    {
        $html = '';

        ob_start();
        View::element(
                $this->defsElements['setting'][0],
                [
                    'item' => $this->model,
                    'nsLabelAttribute' => $this->defsElements['label'][0],
                    'pkgHandleLabel' => $this->defsElements['label'][1],
                ],
                $this->defsElements['setting'][1]
        );
        $html .= ob_get_clean();

        return $html;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

}
