<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models;

use Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;

abstract class AbstractTabContentModel implements TabContentModelable
{

    use CanLoadByGetMethod;

    protected $pkgFileConfig;
    protected $classView;

    /**
     * The config namespace of the content definition.
     *
     * @var     string              A dot separated config namespace.
     */
    protected $src;

    public function __construct(array $data)
    {
        $this->load($this->fixValues($data));
    }

    public function getClassView()
    {
        return $this->classView;
    }

    public function getPkgFileConfig()
    {
        return $this->pkgFileConfig;
    }

    public function getSrc()
    {
        return $this->src;
    }

    protected function fixValues(array $data)
    {
        return $data;
    }

}
