<?php

namespace Concrete\Package\Ht7C5Base\Controller\SinglePage;

use \Concrete\Core\Http\ResponseFactory;
use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Permission\Checker as Permissons;
use \Concrete\Core\Support\Facade\Url;

//use \Concrete\Core\User\User;

abstract class AbstractRedirectToFirstChild extends DashboardPageController
{

    protected function redirectToFirstChild()
    {
//        $u = $this->app->make(User::class);
        $responseFactory = $this->app->make(ResponseFactory::class);
        $children = $this->c->getCollectionChildren();

        if (empty($children)) {
            return $responseFactory->notFound('');
        } else {
            $firstChild = $children[0];

            foreach ($children as $child) {
                if ((new Permissons($child))->canViewPage()) {
                    return $responseFactory->redirect(Url::to($child));
                }
            }

            return $responseFactory->forbidden(Url::to($firstChild));
        }
    }

    public function view()
    {
//        echo "<h1>hier...</h1>";
        return $this->redirectToFirstChild();
    }

}
