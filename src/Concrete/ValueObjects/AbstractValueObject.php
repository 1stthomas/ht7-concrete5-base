<?php

namespace Concrete\Package\Ht7C5Base\ValueObjects;

use \Concrete\Package\Ht7C5Base\Traits\CanLoadByGetMethod;

abstract class AbstractValueObject
{

    use CanLoadByGetMethod;

    public function __construct(array $data)
    {
        $this->load($data);
    }

}
