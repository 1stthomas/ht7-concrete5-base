<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings;

use \Concrete\Package\Ht7C5Base\Services\AbstractService;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AttributeModel;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Views\AttributeItemView;

class SettingsFactory extends AbstractService
{

    public function __construct(\Concrete\Core\Application\Application $app)
    {
        parent::__construct($app);

//        $this->validator = $app->make('helper/ht7/tools/tabs/validator/definitions');
    }

    /**
     * Create the printables according to the definitions.
     *
     * @param   DefinitionTypable   $definitions
     * @param   array               $where          Only items which meet the
     *                                              filter will be returned.
     * @return  AttributeItemView[]
     */
    public function createPrintables(DefinitionTypable $definitions, array $where = [])
    {
        $configDefs = $definitions->getConfigByKey('definitions');
        $nsDefs = $definitions->getNamespaceByKey('definitions');
        $items = $configDefs->get($nsDefs, []);

        if (empty($items)) {
            return;
        }

        $printables = [];
        foreach ($items as $key => $item) {
            if ($this->checkWhere($item, $where)) {
                $model = $this->createAttributeModel($key, $item, $configDefs);
                $defsElements = $definitions->get('elements');

                $printables[$model->getName()] = new AttributeItemView($model, $defsElements);

                $printables[$model->getName()]->render();
            }
        }

        return $printables;
    }

    protected function checkWhere(array $item, array $where = [])
    {
        $return = true;

        foreach ($where as $key => $value) {
            if (isset($item[$key]) && $item[$key] !== $value) {
                return false;
            }
        }

        return $return;
    }

    protected function createAttributeModel(string $key, array $item, $config)
    {
        return new AttributeModel([
            'definitions' => $item,
            'name' => $key,
            'namespace' => $item['nsValue'],
            'pkgFileConfig' => $config,
            'valueOld' => $config->get($item['nsValue']),
        ]);
    }

}
