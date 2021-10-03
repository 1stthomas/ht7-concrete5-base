<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools;

use \Concrete\Package\Ht7C5Base\Ht7Tools\AbstractToolController;

abstract class AbstractConfigableToolController extends AbstractToolController
{

    protected $config;
    protected $factory;
    protected $factoryClass;
    protected $namespace;

    public function __construct($config, string $namespace)
    {
        parent::__construct();

        $this->config = $config;
        $this->namespace = $namespace;
    }

}
