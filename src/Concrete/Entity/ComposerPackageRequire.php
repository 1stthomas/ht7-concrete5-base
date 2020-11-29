<?php

namespace Concrete\Package\Ht7Concrete5Base\Entity;

/**
 * @ComposerPackageRequires(repositoryClass="\Concrete\Package\Ht7Concrete5Base\Repository\ComposerPackageRequireRepository")
 */
class ComposerPackageRequire extends OrmEntityExtended
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
    protected $version;

    public function getName()
    {
        return $this->name;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setVersion(string $version)
    {
        $this->version = $version;
    }

}
