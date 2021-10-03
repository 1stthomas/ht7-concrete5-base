<?php

namespace Concrete\Package\Ht7C5Base\Entity;

use \Concrete\Core\Support\Facade\Application;
use \Concrete\Package\Ht7C5Base\Traits\CanLoad;
use \Doctrine\ORM\EntityManagerInterface;
use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class OrmEntityExtended extends OrmEntityBase implements \Serializable
{

    use CanLoad;

    /**
     * If set true and the Entity has the Property "deletedAt", calling delete()
     * will not remove the Entity instead the deletedAt value will be set.
     * @var type
     */
    protected static $safeDelete = true;

    /**
     * @var Integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $deletedAt;

    public function __construct(array $data = [])
    {
        parent::__construct();

        $this->load($data);
    }

    /**
     * @return Integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     *
     * @return  array                   Assoc array of all properties of the
     *                                  present instance.
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
        $arr = unserialize($data);

        $this->load($arr);
    }

    /**
     * Return whetever the safe delete functionality is activated or not.
     *
     * @return  boolean
     */
    public static function isActiveSafeDelete()
    {
        return static::$safeDelete;
    }

    /**
     * Return the entity belonging to the submitted id.
     *
     * @param   integer $id                         The id of the entity to retrieve.
     * @param   boolean $respectSafeDeleteProperty  True if the safe delete property
     *                                      should be respected.
     * @return  mixed           The entity belonging to the submitted id.
     */
    public static function getByID($id, $respectSafeDeleteProperty = true)
    {
        $em = Application::getFacadeApplication()
                ->make(EntityManagerInterface::class);

        if ($respectSafeDeleteProperty && static::$safeDelete) {
            return $em->getRepository(static::class)
                            ->findOneBy([
                                'id' => $id,
                                'deletedAt' => null
            ]);
        } else {
            return $em->getRepository(static::class)->find($id);
        }
    }

    /**
     * Return the entity with the submitted id or throw a MeschPageNotFoundException.
     *
     * @param   integer $id                         The id of the entity to retrieve.
     * @param   boolean $respectSafeDeleteProperty  True if the safe delete property
     *                                      should be respected.
     * @return  mixed
     * @throws  MeschPageNotFoundException
     */
    public static function getOrFailByID($id, $respectSafeDeleteProperty = true)
    {
        $item = static::getByID($id, $respectSafeDeleteProperty);

        if (is_object($item)) {
            return $item;
        } else {
            // Compose the human readable entity name for the excpetion message.
            $classNs = static::class;
            $className = substr($classNs, strrpos($classNs, '\\') + 1);
            $entityName = strpos($className, 'MeschCm') !== false ? str_replace('MeschCm', '', $className) : $className;

            $msg = tc(
                    'ht7_c5_base',
                    'The requested %1$s with the id %2$s could not be found.',
                    $entityName, $id
            );
            throw new \InvalidArgumentException($msg);
        }
    }

}
