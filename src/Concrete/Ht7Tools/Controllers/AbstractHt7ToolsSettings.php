<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Controllers;

use \Concrete\Core\Http\Response;
use \Concrete\Core\Http\ResponseFactoryInterface;
use \Concrete\Core\Page\Page;
use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Permission\Checker as Permissons;
use \Concrete\Core\Support\Facade\Url;
use \Concrete\Core\Support\Facade\Application as ApplicationFacade;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements\HeaderItem;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements\PageDefinitions;

abstract class AbstractHt7ToolsSettings extends DashboardPageController
{

    /**
     * This property must be overriden.
     *
     * @var PageDefinitions         Object with all related definitions to display
     *                              and save the desired settings.
     */
    protected $definitions;

    /**
     * Specifies the header items to include in the view method.
     * This property can be overriden.
     *
     * @var array                   Indexed array of config namespaces.
     */
    protected $headerItems;

    /**
     * Not in use atm...
     *
     * @var string
     */
    protected $viewTemplate;

    public function __construct(Page $c)
    {
        parent::__construct($c);

        $this->setApplication(ApplicationFacade::getFacadeApplication());

        $pkgFileConfig = $this->app->make('helper/ht7/package/base')
                ->getPackageFileConfig($this);

        $this->headerItems = [
            ['header_items.settings', $pkgFileConfig]
        ];
    }

    public function save()
    {
        $responseFactory = $this->app->make(ResponseFactoryInterface::class);

        $count = count($_REQUEST);

        \Log::addEntry(print_r($_REQUEST, true));

        if ($count > 0) {
            $errors = $this->definitions
                    ->getDefinitions()
                    ->getFormProcessor()
                    ->process($_REQUEST);
        }

        if (empty($errors)) {
            $msg = $count > 1 || $count !== 1 ?
                    tc('ht7_c5_base', '%s values have been updated.', $count) :
                    tc('ht7_c5_base', '%s value has been updated.', $count);

            $body = [
                'count_updated' => $count,
                'success' => $msg,
            ];
            $header = Response::HTTP_OK;
        } else {
            $items = array_reduce($errors, function($carry, $item) {
                $carry .= '- ' . $item->getDefinitions()['label'] . "\n";

                return $carry;
            });

            $body = [
                'count_updated' => $count - count($errors),
                'error' => tc(
                        'ht7_c5_base',
                        "Following settings could not been updated:\n%s",
                        $items
                ),
            ];

            $header = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        if ($this->getRequest()->isXmlHttpRequest()) {
            return $responseFactory->json($body, $header);
        } else {
            $key = $header === Response::HTTP_OK ? 'success' : 'error';

            $this->flash($key, $body[$key], false);

            return $responseFactory->redirect($this->action());
        }
    }

    public function view()
    {
        $this->requireAsset('javascript', 'ht7-widgets/concrete5');
        $this->requireAsset('ht7-widgets/body-overlay');
        $this->requireAsset('ht7-tools/settings');

        $this->setupHeaderItems();

        $pkgH = $this->app->make('helper/ht7/package/base');
        $pkgFileConfig = $pkgH->getPackageFileConfig($this);

//        $tabsModels =

        $this->set(
                'isActiveBsTooltips',
                $pkgFileConfig->get('settings.general.showBsTooltips', false)
        );
        $this->set(
                'isSavedByAjax',
                $pkgFileConfig->get('settings.general.saveByAjax', false)
        );
        $this->set(
                'isBordered',
                $pkgFileConfig->get('settings.styles.tableStyleBordered', false)
        );
        $this->set(
                'isStripped',
                $pkgFileConfig->get('settings.styles.tableStyleStripped', false)
        );
        $this->set('definitions', $pkgFileConfig->get('tabs.settings'));
        $this->set('fH', $this->app->make('helper/form'));
//        $this->set('nsTabs', 'tabs.settings');
        $this->set('pkgFileConfig', $pkgFileConfig);
        $this->set('pkgHandle', $pkgH->getPackageHandle($this));
        $this->set('pkgHandleBase', $pkgH->getPackageHandle());
        $this->set('urlSave', $this->action('save'));
        $this->set('urlReset', $this->action());

        $this->set('views', $this->definitions->getViews());
    }

    protected function setupHeaderItems()
    {
        foreach ($this->headerItems as $item) {
            $headerItem = new HeaderItem($item[1], $item[1]->get($item[0]));
            $this->addHeaderItem((string) $headerItem);
        }
    }

}
