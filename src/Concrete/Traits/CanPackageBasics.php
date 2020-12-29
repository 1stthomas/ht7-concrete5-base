<?php

namespace Concrete\Package\Ht7C5Base\Traits;

use \Concrete\Core\Package\PackageService;
use \Concrete\Core\Support\Facade\Application;
use \Doctrine\ORM\EntityManagerInterface;

//use \Concrete\Core\Package\PackageService;

/**
 *
 * @author Thomas Plüss
 */
trait CanPackageBasics
{

    /**
     * @var     \Doctrine\ORM\EntityManagerInterface
     */
    protected static $em;

    /**
     * @var     string      The package handle.
     * @todo                Must be handled by the ht7-base/registry!
     */
    protected static $pkgHandle = 'ht7_concrete5_base';
    protected static $pkg;

    /**
     * Return the Application Facade.
     *
     * Sometimes this property is allready instanciated by the c5 base controller.
     * Therfor we can not define it as a class variable.
     *
     * @return  \Concrete\Core\Support\Facade\Application
     */
    protected function getApp()
    {
        if (!is_object($this->app)) {
            $this->app = Application::getFacadeApplication();
        }

        return $this->app;
    }

    /**
     * Get the ORM Doctrine entity manager.
     *
     * @return  \Doctrine\ORM\EntityManagerInterface    The entity manager instance.
     */
    protected function getEm()
    {
        if (is_null(static::$em)) {
            static::$em = $this->getApp()->make(EntityManagerInterface::class);
        }

        return static::$em;
    }

    /**
     * Return the current package entity.
     *
     * @return  \Concrete\Core\Package\Package
     */
    protected static function getPackage()
    {
        if (is_null(self::$pkg)) {
            static::$pkg = static::getApp()
                    ->make(PackageService::class)
                    ->getByHandle(static::$pkgHandle);
        }

        return self::$pkg;
    }

}
