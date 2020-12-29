<?php

namespace Concrete\Package\Ht7C5Base\Entity;

use \DateTime;
use \Concrete\Package\Ht7C5Base\Traits\CanPackageBasics;

/**
 * @MappedSuperclass
 */
class OrmEntityBase
{

    use CanPackageBasics;

    /**
     * The c5 application facade.
     *
     * @var     \Concrete\Core\Support\Facade\Application
     */
    protected static $app;

    /**
     * Create a new instance of the underlying entity.
     *
     * If the properties<code>createdAt</code> and/or <code>updatedAt</code>
     * exist, their value will be set with <code>new DateTime('now')</code>.
     *
     */
    public function __construct()
    {
        if (property_exists($this, 'createdAt')) {
            $this->createdAt = new DateTime('now');
        }
        if (property_exists($this, 'updatedAt')) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * Delete the current enitity.
     *
     * If the property <code>safeDelete</code> exists and is true and the
     * property <code>deletedAt</code> exists as too, the current entity will
     * not be deleted from the DB, instead the <code>deletedAt</code> will be
     * set to <code>new DateTime('now')</code>. Otherwise the current entity
     * will be removed from the DB.
     *
     * @param   boolean     $respectSettings        If false, the entity will
     *                                  really be removed from db wheter or not
     *                                  the <code>self::$safeDelete</code> is
     *                                  true.
     */
    public function delete($respectSettings = true)
    {
        if (property_exists(get_called_class(), 'safeDelete') && static::$safeDelete && property_exists($this, 'deletedAt') && $respectSettings) {
            $this->deletedAt = new DateTime('now');
            if (property_exists($this, 'updatedAt')) {
                $this->updatedAt = new DateTime('now');
            }
            $this->save();
        } else {
            $em = self::getEm();
            $em->remove($this);
            $em->flush();
        }
    }

    /**
     * Persist the current into the DB.
     *
     * If the property <code>updatedAt</code> exists, its value will be changed
     * to <code>new DateTime('now')</code>.
     */
    public function save()
    {
        if (property_exists($this, 'updatedAt')) {
            $this->updatedAt = new DateTime('now');
        }
        $em = self::getEm();
        $em->persist($this);
        $em->flush();
    }

}
