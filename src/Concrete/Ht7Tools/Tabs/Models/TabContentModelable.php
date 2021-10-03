<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models;

interface TabContentModelable
{

    public function getClassView();

    public function getPkgFileConfig();

    /**
     * Get the config namespace.
     *
     * @return  string              The config namespace to the content definitions.
     */
    public function getSrc();
}
