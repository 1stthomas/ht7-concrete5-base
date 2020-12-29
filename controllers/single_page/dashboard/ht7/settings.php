<?php

namespace Concrete\Package\Ht7C5Base\Controller\SinglePage\Dashboard\Ht7;

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Page\Page;

defined('C5_EXECUTE') or die('Access Denied.');

class Settings extends DashboardPageController
{

    public function getCollectionDescription()
    {
        return t("Main settings page for ht7 applications.");
    }

    public function view()
    {
        $c = Page::getCurrentPage();
        $pages = $c->getCollectionChildren();
        $this->set('pages', $pages);
    }

}
