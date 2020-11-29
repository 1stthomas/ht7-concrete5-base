<?php

namespace Concrete\Package\Ht7Concrete5Base\Controller\SinglePage\Dashboard\Ht7;

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Page\Page;

defined('C5_EXECUTE') or die('Access Denied.');

class Environment extends DashboardPageController
{

    public function getCollectionDescription()
    {
        return t("Default Settings Page for Ht7 Tools");
    }

    public function view()
    {
        $c = Page::getCurrentPage();
        $pages = $c->getCollectionChildren();
        $this->set('pages', $pages);
    }

}
