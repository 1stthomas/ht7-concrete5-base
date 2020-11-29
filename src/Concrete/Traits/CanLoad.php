<?php

namespace Concrete\Package\Ht7Concrete5Base\Traits;

/**
 * This trait provides a method to load an object with an associated array.
 * The key must be the property name, whereas the value must be the property
 * value.
 *
 * @author  Thomas Plüss
 * @todo    Move this trait into the ht7-base
 */
trait CanLoad
{

    /**
     * @var     \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     */
    protected static $fb;

    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }

}
