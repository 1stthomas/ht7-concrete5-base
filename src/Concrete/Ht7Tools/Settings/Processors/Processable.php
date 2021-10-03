<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AttributeModel;

interface Processable
{

    /**
     * Process the form submission by saving all found values according to the
     * definitions.
     *
     * @param   array   $values             Assoc array of the form values.
     *                                      Normally something like <code>$_REQUEST</code>.
     * @return  AttributeModel[]            An empty array or an indexed array
     *                                      of attribute models which could not
     *                                      be saved.
     */
    public function process(array $values);
}
