<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors\Processable;

interface DefinitionTypable
{

    /**
     * Get the value of a specific definition.
     *
     * @param   string  $key            The key of the definition to retrieve.
     * @return  mixed                   The found config value.
     */
    public function get(string $key);

    /**
     * Get the file config for the present key.
     *
     * This is the config which is used to get the values.
     *
     * @param   string  $key            The key to get the config from.
     * @return  mixed                   The config.
     */
    public function getConfigByKey(string $key);

    /**
     * Get the form processor instance for the present definition type.
     *
     * @return  Processable             A form processor.
     */
    public function getFormProcessor();

    /**
     * Get the namespace of the present key.
     *
     * @param   string  $key            The key to get the namespace from.
     * @return  string                  The namespace of the present key.
     */
    public function getNamespaceByKey(string $key);

    /**
     * Return wheter an item with the present key is set or not.
     *
     * @param   string  $key
     * @return  bool                    True if an item with the present key is set.
     */
    public function has(string $key);
}
