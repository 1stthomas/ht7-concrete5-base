<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models;

use Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;

class TabModel
{

    use CanLoadByGetMethod;

    protected $content;
    protected $id;
    protected $label;
    protected $isSelected;
    protected $propertyMappings = [];

    public function __construct(array $data)
    {
        $this->isSelected = false;
        $this->propertyMappings = [
            'name' => 'label',
            'selected' => 'isSelected',
        ];

        $this->load($this->fixValues($data));
    }

    public function getArrayForC5Helper()
    {
        return [
            $this->getId(),
            $this->getLabel(),
            $this->isSelected,
        ];
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getIsSelected()
    {
        return $this->isSelected;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    protected function fixValues(array $data)
    {
        foreach ($this->propertyMappings as $key => $newKey) {
            if (isset($data[$key])) {
                $data[$newKey] = $data[$key];

                unset($data[$key]);
            }
        }

        return $data;
    }

}
