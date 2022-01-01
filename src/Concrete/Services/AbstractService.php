<?php

namespace Concrete\Package\Ht7C5Base\Services;

use \Concrete\Core\Application\Application;
use \Concrete\Core\Application\ApplicationAwareInterface;
use \Concrete\Core\Application\ApplicationAwareTrait;

abstract class AbstractService implements ApplicationAwareInterface
{

    use ApplicationAwareTrait;
    /**
     * @var     Application             The application container.
     */
    protected $app;

    /**
     * Create an instance of the mesch_table package controller.
     *
     * @param   Application     $app
     */
    public function __construct(Application $app)
    {
        $this->setApplication($app);
    }
}
