<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors\Processable;

abstract class AbstractDefinitionType implements DefinitionTypable
{

    /**
     * @var array
     */
    protected $definitions;

    /**
     * @var Processable
     */
    protected $formProcessor;

    public function __construct(array $definitions)
    {
        $this->definitions = $definitions;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        if ($this->has($key)) {
            return $this->definitions[$key];
//            return $this->getConfigByKey($key)->get($this->getNamespaceByKey($key));
        } else {
            $e = tc('ht7_c5_base', 'Unsupported definition type key %s.', $key);

            throw new \InvalidArgumentException($e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigByKey(string $key)
    {
        return $this->definitions[$key][1];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormProcessor()
    {
        if (empty($this->formProcessor)) {
            $this->createFormProcessor();
        }

        return $this->formProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespaceByKey(string $key)
    {
        return $this->definitions[$key][0];
    }

    public function has($key)
    {
        return isset($this->definitions[$key]);
    }

    /**
     * Create the form processor instance for the present definition type.
     */
    abstract protected function createFormProcessor();
}
