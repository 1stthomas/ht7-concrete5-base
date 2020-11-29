<?php

namespace Concrete\Package\Ht7Concrete5Base;

use \Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use \Concrete\Package\Ht7Concrete5Base\Service\Files\NameFixer;
use \Concrete\Package\Ht7Concrete5Base\Service\Users\User;

class ServiceProvider extends CoreServiceProvider
{

    public function register()
    {
        $this->app->bind(
                'helper/ht7/file/namefixer',
                NameFixer::class
        );
        $this->app->bind(
                'helper/ht7/users/user',
                User::class
        );

        // Add these classes as singleton to have only one active instance of them.
//        $this->app->singleton(LogEvents::class);
    }

}
