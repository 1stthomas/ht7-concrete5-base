<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AbstractDefinitionType;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors\FormProcessorSimpleType;

class DefinitionsSimpleType extends AbstractDefinitionType
{

    /**
     * {@inheritdoc}
     */
    public function createFormProcessor()
    {
        $this->formProcessor = new FormProcessorSimpleType($this);
    }

}
