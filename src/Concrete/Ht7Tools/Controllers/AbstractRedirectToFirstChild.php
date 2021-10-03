<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Controllers;

use \Concrete\Core\Http\ResponseFactory;
use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Permission\Checker as Permissons;
use \Concrete\Core\Support\Facade\Url;

abstract class AbstractRedirectToFirstChild extends DashboardPageController
{

    public function view()
    {
        return $this->redirectToFirstChild();
    }

    /**
     * Redirect to the first child of the current page.
     *
     * This method will redirect to 404 if no children can be found. In case of
     * present children, the first child with access permissions will be choosen
     * for the redirection. If the current user has no permission to any child
     * the response will be 403.
     *
     * @return \Concrete\Core\Http\Response
     */
    protected function redirectToFirstChild()
    {
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

}
