<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models;

use Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;

class LabelModel
{

    use CanLoadByGetMethod;

    protected $for;
    protected $label;
    protected $title;

    public function __construct(array $data)
    {
        $this->load($data);
    }

    public function getFor()
    {
        return $this->for;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getTitle()
    {
        return $this->title;
    }

}
