<?php

namespace Concrete\Package\Ht7C5Base\Services;

use \Concrete\Core\Block\Block;
use \Concrete\Core\Package\PackageService;

class PackageBase extends AbstractService
{

    /**
     * @var     string
     */
    protected $pkgHandle;

    /**
     * Get the package entity.
     *
     * In case an object has been submitted, its package will be taken.
     * Otherwise it will evaluate the package handle from this file and retrieve
     * the package entity by this handle.
     *
     * @param   mixed                           $obj    An instance of a class from the
     *                                      searched package or null.
     * @return  \Concrete\Core\Entity\Package
     */
    public function getPackage($obj = null)
    {
        if (is_object($obj)) {
            if ($obj instanceof Block) {
                return $this->app->make(PackageService::class)
                                ->getByID($obj->getPackageID());
            } else {

            }
        } else {
            $pkgHandle = $this->getPackageHandle();

            return $this->app->make(PackageService::class)
                            ->getByHandle($pkgHandle);
        }
    }

    /**
     * Get the database config with the predefined namespace according to the
     * current package.
     *
     * @param   mixed   $obj
     * @return  type
     */
    public function getPackageConfig($obj = null)
    {
        return $this->getPackage($obj)
                        ->getController()
                        ->getConfig();
    }

    /**
     * Get the file config with the predefined namespace according to the
     * current package.
     *
     * @param   mixed   $obj
     * @return  type
     */
    public function getPackageFileConfig($obj = null)
    {
        return $this->getPackage($obj)
                        ->getController()
                        ->getFileConfig();
    }

    /**
     * Get the package handle.
     *
     * @param   mixed       $obj            An instance of a class from the
     *                                      searched package or null.
     * @return  string
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getPackageHandle($obj = null)
    {
        if (is_object($obj) && $obj instanceof Block) {
            $pkg = $this->getPackage($obj);

            if (is_object($pkg)) {
                return $pkg->getPackageHandle();
            } else {
                $e = 'Could not determine a valid package handle.';

                throw new \InvalidArgumentException($e);
            }
        } else {
            if ($obj === null) {
                // The handle of the this package will be returned.

                if (empty($this->pkgHandle)) {
                    $obj = $this;
                } else {
                    return $this->pkgHandle;
                }
            } elseif (!is_object($obj)) {
                $e = 'The first parameter needs to be an object or null, found '
                        . gettype($obj);

                throw new \InvalidArgumentException($e);
            }

            $parts = explode('\\', get_class($obj));

            if (count($parts) > 3) {
                $handle = uncamelcase($parts[2]);

                if ($obj === $this) {
                    // Cache the handle.
                    $this->pkgHandle = $handle;
                }

                return $handle;
            } else {
                $e = 'Something is wrong with the underlying package.'
                        . ' Could not determine a valid package handle.';

                throw new \RuntimeException($e);
            }
        }
    }

}
