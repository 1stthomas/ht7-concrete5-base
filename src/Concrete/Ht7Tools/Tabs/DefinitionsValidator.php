<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Tabs;

use \Concrete\Package\Ht7C5Base\Services\AbstractService;

class DefinitionsValidator extends AbstractService
{

    public function validateTabContent(array $data)
    {
        $errors = [];

        if (empty($data['model_type'])) {
            $errors[] = 'model_type';
        }
        if (empty($data['src'])) {
            $errors[] = 'src';
        }

        if ($errors) {
            $msg = 'Missing tab content definition' . count($errors) > 1 ? 's' : '' . ': ';
            $msg .= implode(', ', $errors) . '.';

            throw new \InvalidArgumentException($msg);
        }

        return true;
    }

}
