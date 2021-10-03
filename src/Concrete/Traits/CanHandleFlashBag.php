<?php

namespace Concrete\Package\Ht7C5Base\Traits;

use \Concrete\Core\Support\Facade\Application;
use \Doctrine\ORM\EntityManagerInterface;

/**
 * This trait provides some methods to handle the Symfony FlashBag to set and
 * get specific session values.
 *
 * @author Thomas Plüss
 */
trait CanHandleFlashBag
{

    /**
     * @var     \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     */
    protected static $fb;

    /**
     * Return the Symfony FlashBag instance.
     *
     * @return  \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     */
    protected function getFlashBag()
    {
        if (is_null(static::$fb)) {
            static::$fb = Application::getFacadeApplication()
                    ->make('session')
                    ->getFlashBag();
        }

        return static::$fb;
    }

    /**
     *
     * @param   string      $key            The property name to retrive from the
     *                                      FlashBag.
     * @param   boolean     $doSanitize     True if from a possible array should
     *                                      only be taken the first element.
     * @return  string                      The value found by $key.
     */
    protected function getFlashBagValue($key, $doSanitize = true)
    {
        $value = $this->getFlashBag()->get($key);

        if ($doSanitize) {
            if (is_array($value) && isset($value[0])) {
                return $value[0];
            }
        }

        return $value;
    }

    /**
     * Set an error message into the session.
     *
     * @param   string      $text       The text to put into the session.
     */
    protected function setErrorMessage($text)
    {
        $this->setMessage('error', $text);
    }

    /**
     * Set a value to a specified session key.
     *
     * @param   string  $key        The identificator which will be used as
     *                              the session array key.
     * @param   mixed   $value      The value of the specified session key.
     */
    protected function setFlashBagValue($key, $value)
    {
        $fb = $this->getFlashBag();

        $fb->set($key, $value);
    }

    /**
     *
     * @param   string  $type       The type of the message. Supported types:
     *                              success, error
     * @param   string  $text       The text to display as a message.
     */
    protected function setMessage($type, $text)
    {
        $this->setFlashBagValue($type, $text);
    }

    /**
     * Set a success message into the session.
     *
     * @param   string      $text       The text to put into the session.
     */
    protected function setSuccessMessage($text)
    {
        $this->setMessage('success', $text);
    }

}
