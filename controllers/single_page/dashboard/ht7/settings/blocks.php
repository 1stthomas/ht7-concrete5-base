<?php

namespace Concrete\Package\Ht7Concrete5Base\Controller\SinglePage\Dashboard\Ht7\Settings;

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Page\Page;

defined('C5_EXECUTE') or die('Access Denied.');

class Blocks extends DashboardPageController
{

    public function getCollectionDescription()
    {
        return t("Main settings page for ht7 blocks");
    }

    public function view()
    {
        $c = Page::getCurrentPage();
        $pages = $c->getCollectionChildren();
        $this->set('pages', $pages);
    }

}
