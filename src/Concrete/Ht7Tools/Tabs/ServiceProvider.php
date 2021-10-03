<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs;

use \Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\DefinitionsValidator;

class ServiceProvider extends CoreServiceProvider
{

    public function register()
    {
        $this->app->bind(
                'helper/ht7/tools/tabs/validator/definitions',
                DefinitionsValidator::class
        );
    }

}
