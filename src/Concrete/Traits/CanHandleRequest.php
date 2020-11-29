<?php

namespace Concrete\Package\Ht7Concrete5Base\Traits;

use \Concrete\Core\Http\Request;

/**
 *
 * @author Thomas Plüss
 */
trait CanHandleRequest
{

    use CanPackageBasics;

    /**
     * @var     \Concrete\Core\Http\Request
     */
    protected static $req;

    /**
     * Get the $_GET array of the current session.
     *
     * This method orders the array through the symfony request objects.
     *
     * @return  array                       Assoc array with form field keys as
     *                                      kays and the related value as value.
     */
    public function getGetArray()
    {
        return $this->getRequest()->query->all();
    }

    /**
     * Get the $_POST array of the current session.
     *
     * This method orders the array through the symfony request objects.
     *
     * @return  array                       Assoc array with form field keys as
     *                                      kays and the related value as value.
     */
    public function getPostArray()
    {
        return $this->getRequest()->request->all();
    }

    /**
     * Get the active request instance.
     *
     * @return  \Concrete\Core\Http\Request
     */
    public function getRequest()
    {
        if (!static::$req) {
            static::$req = static::getApp()->make(Request::class);
        }

        return static::$req;
    }

}
