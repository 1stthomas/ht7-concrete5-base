<?php

namespace Concrete\Package\Ht7C5Base;

use \Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use \Concrete\Package\Ht7C5Base\Services\FileNameFixer;
use \Concrete\Package\Ht7C5Base\Services\PackageBase;
use \Concrete\Package\Ht7C5Base\Services\UserBase;

class ServiceProvider extends CoreServiceProvider
{

    public function register()
    {
        $this->app->bind(
                'helper/ht7/file/namefixer',
                FileNameFixer::class
        );
        $this->app->bind(
                'helper/ht7/package/base',
                PackageBase::class
        );
        $this->app->bind(
                'helper/ht7/user/base',
                UserBase::class
        );
    }

}
