<?php

namespace Concrete\Package\Ht7C5Base\Controller\SinglePage\Dashboard;

use \Concrete\Core\Page\Page;
use \Concrete\Core\Page\Controller\DashboardPageController;

defined('C5_EXECUTE') or die('Access Denied.');

class Ht7 extends DashboardPageController
{

    public function getCollectionDescription()
    {
        return t("Ht7 Starting Page");
    }

    public function view()
    {
        $c = Page::getCurrentPage();
        $pages = $c->getCollectionChildren();
        \Log::addEntry('count ' . count($pages));
        $this->set('pages', $pages);
    }

}
