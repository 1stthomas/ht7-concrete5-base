<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs;

use \Concrete\Package\Ht7C5Base\Services\AbstractService;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models\TabsModel;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Models\TabModel;

class TabFactory extends AbstractService
{

    protected $pkgFileConfig;

    /**
     *
     * @var Concrete\Package\Ht7C5Base\Ht7Tools\Settings\DefinitionsValidator
     */
    protected $validator;

    public function __construct(\Concrete\Core\Application\Application $app)
    {
        parent::__construct($app);

        $this->validator = $app->make('helper/ht7/tools/tabs/validator/definitions');
    }

    public function createTabsModel(array $definitions = [])
    {
        if (empty($definitions) || empty($definitions['items'])) {
            return;
        }

        $tabs = [];

        foreach ($definitions['items'] as $item) {
            $model = $this->createTabModel($item);
            $tabs[$model->getId()] = $model;
        }

        return new TabsModel($tabs, (empty($definitions['markup']) ? [] : $definitions['markup']));
    }

    public function createTabIdArray(array $definitions = [])
    {
        $ids = [];

        if (is_array($definitions['items'])) {
            foreach ($definitions['items'] as $item) {
                $ids[] = $item['id'];
            }
        }

        return $ids;
    }

    public function createTabModel(array $data)
    {
        return new TabModel($data);
    }

    public function replaceContent(array $tabs, array $content = [])
    {
        foreach ($content as $id => $printable) {
            if (isset($tabs[$id])) {
                $tabs[$id]->setContent($printable);
            }
        }

        return $tabs;
    }

}
