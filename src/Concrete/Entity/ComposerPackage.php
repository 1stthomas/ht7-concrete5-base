<?php

namespace Concrete\Package\Ht7Concrete5Base\Entity;

/**
 * @Entity
 * @Table(name="Ht7ComposerPackages")
 */
class ComposerPackage extends OrmEntityExtended
{

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $commit;

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $version;

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $sourceUrl;

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $sourceType;

    /**
     * @var string
     *
     * @Column(type="string", nullable=false, length=255)
     */
    protected $type;

    /**
     * @var boolean
     *
     * @Column(type="boolean", nullable=false)
     */
    protected $isInstalled;

    /**
     * @return string
     */
    public function getCommit()
    {
        return $this->commit;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $commit
     */
    public function setCommit(string $commit)
    {
        $this->commit = $commit;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $sourceType
     */
    public function setSourceType(string $sourceType)
    {
        $this->sourceType = $sourceType;
    }

    /**
     * @param string $sourceUrl
     */
    public function setSourceUrl(string $sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

}
