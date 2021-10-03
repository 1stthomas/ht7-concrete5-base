<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models;

use \Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\LabelModel;

class AttributeModel
{

    use CanLoadByGetMethod;

    protected $definitions;
    protected $labelModel;
    protected $name;
    protected $namespace;
    protected $pkgFileConfig;
    protected $valueNew;
    protected $valueOld;

    public function __construct(array $data)
    {
        $this->load($data);

        $this->labelModel = new LabelModel([
            'for' => $this->definitions['name'],
            'label' => $this->definitions['label'],
            'title' => $this->definitions['title'],
        ]);

        $this->valueOld = $this->pkgFileConfig
                ->get($this->getNamespace() . '.' . $this->getName());
    }

    public function getDefinitions()
    {
        return $this->definitions;
    }

    public function getLabelModel()
    {
        return $this->labelModel;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getPkgFileConfig()
    {
        return $this->pkgFileConfig;
    }

    public function getValueNew()
    {
        return $this->valueNew;
    }

    public function getValueOld()
    {
        return $this->valueOld;
    }

    public function isSaved()
    {
        return $this->getPkgFileConfig()->get($this->getNamespace() . '.' . $this->getName()) ===
                $this->getValueNew();
    }

    public function save()
    {
        $this->getPkgFileConfig()->save(
                $this->getNamespace() . '.' . $this->getName(),
                $this->getValueNew()
        );
    }

    protected function transformValue(string $key, $value)
    {
        $valueTransformed = $value;

        if ($key === 'valueNew') {
            if ($this->definitions['type'] === 'boolean') {
                $valueTransformed = $value ? true : false;
            }
        }

        return $valueTransformed;
    }

}
