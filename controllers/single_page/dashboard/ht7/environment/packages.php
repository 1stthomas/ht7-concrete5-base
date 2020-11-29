<?php

namespace Concrete\Package\Ht7Concrete5Base\Controller\SinglePage\Dashboard\Ht7\Environment;

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Page\Page;

defined('C5_EXECUTE') or die('Access Denied.');

class Packages extends DashboardPageController
{

    public function getCollectionDescription()
    {
        return t("Default Settings Page for Ht7 Tools");
    }

    public function list($filter)
    {

    }

    public function view()
    {
        $c = Page::getCurrentPage();
        $pages = $c->getCollectionChildren();
        $this->set('pages', $pages);
    }

}
