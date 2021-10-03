<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools;

use \Concrete\Core\Application\Application;
use \Concrete\Core\Support\Facade\Application as ApplicationFacade;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Printable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Renderable;

abstract class AbstractToolController implements Printable
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Renderable
     */
    protected $view;

    public function __construct()
    {
        $this->app = ApplicationFacade::getFacadeApplication();
    }

    public function __toString()
    {
        return $this->getView()->render();
    }

    public function getFactory()
    {
        if (empty($this->factory)) {
            $this->factory = new $this->factoryClass($this->app);
        }

        return $this->factory;
    }

    /**
     *
     * @return  Renderable
     */
    public function getView()
    {
        if (empty($this->view)) {
            $this->setupView();
        }

        return $this->view;
    }

    abstract protected function setupView();
}
