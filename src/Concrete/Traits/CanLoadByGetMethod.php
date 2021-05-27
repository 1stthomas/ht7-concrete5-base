<?php

namespace Concrete\Package\Ht7C5Base\Traits;

/**
 *
 * @author Thomas Plüss
 */
trait CanLoadByGetMethod
{

    public function load(array $data)
    {
        foreach ($data as $name => $value) {
            $methodName = 'get' . ucfirst($name);

            if (method_exists($this, $methodName)) {
                $this->$name = $value;
            }
        }
    }

}
