<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors\Processable;

abstract class AbstractFormProcessor implements Processable
{

    /**
     * @var DefinitionTypable
     */
    protected $definitions;

    public function __construct(DefinitionTypable $definitions)
    {
        $this->definitions = $definitions;
    }

}
