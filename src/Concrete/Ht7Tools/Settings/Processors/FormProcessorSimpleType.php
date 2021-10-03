<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors;

use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AttributeModel;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Processors\AbstractFormProcessor;

class FormProcessorSimpleType extends AbstractFormProcessor
{

    /**
     * {@inheritdoc}
     */
    public function process(array $values)
    {
        $models = $this->gatherModels($values);
        $errors = [];

        foreach ($models as $model) {
            // @todo: validate input!!!
            $model->save();

            if (!$model->isSaved()) {
                $errors[] = $model;
            }
        }

        return $errors;
    }

    /**
     * Gather the models of all requested settings which are defined accordingly.
     *
     * @param   array           $values     Assoc array of form values, e.g. <code>$_REQUEST</code>.
     * @return  AttributeModel[]            Indexed array of setting models.
     */
    protected function gatherModels(array $values)
    {
        $models = [];
        $config = $this->definitions->getConfigByKey('definitions');
        $ns = $this->definitions->getNamespaceByKey('definitions');
        $defs = $config->get($ns);

        foreach ($values as $key => $value) {
            if (array_key_exists($key, $defs)) {
                $models[] = new AttributeModel([
                    'definitions' => $defs[$key],
                    'name' => $key,
                    'namespace' => isset($defs[$key]['nsValue']) ? $defs[$key]['nsValue'] : $this->definitions->getNamespaceByKey('values'),
                    'pkgFileConfig' => $this->definitions->getConfigByKey('definitions'),
                    'valueNew' => $value,
                ]);
            }
        }

        return $models;
    }

}
