<?php

namespace Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Elements;

use \Concrete\Core\Application\Application;
use \Concrete\Core\Support\Facade\Application as ApplicationFacade;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Printable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Controller as SettingsController;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\PageDefinitionTypes;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionTypable;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\DefinitionsSimpleType;
use \Concrete\Package\Ht7C5Base\Ht7Tools\Tabs\Controller as TabsController;

class PageDefinitions
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var DefinitionTypable
     */
    protected $definitions;

    /**
     * @var array               Assoc array of PageDefinitionTypes as keys and
     *                          their mapped class.
     */
    protected $mappingsDefinitions = [
        PageDefinitionTypes::SIMPLE => DefinitionsSimpleType::class,
    ];

    /**
     * @var array               Assoc array of PageDefinitionTypes as keys and
     *                          their mapped class.
     */
    protected $mappingsViews = [
//        PageDefinitionTypes::SIMPLE => DefinitionsSimpleType::class,
    ];

    /**
     * @var int
     */
    protected $type;

    /**
     * @var Printable[]
     */
    protected $views;

    public function __construct(array $data, int $type = PageDefinitionTypes::SIMPLE)
    {
        $this->app = ApplicationFacade::getFacadeApplication();

        $this->setType($type);
        $this->setupDefinitions($data);
        $this->setupViews();
    }

    /**
     *
     * @return  DefinitionTypable
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     *
     * @return Printable[];
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the definitions type.
     *
     * This method checks the defined mappings and throws an exception if the
     * present type has not been found.
     *
     * @param   int     $type
     * @throws  \InvalidArgumentException
     */
    private function setType(int $type)
    {
        if (key_exists($type, $this->mappingsDefinitions)) {
            $this->type = $type;
        } else {
            $e = tc('ht7_c5_base', 'The PageDefinitionsType %s is not supported.', $type);

            throw new \InvalidArgumentException($e);
        }
    }

    /**
     * Create the definitions model instance according to the type and its mapping.
     *
     * @param array $data
     */
    private function setupDefinitions(array $data)
    {
        $this->definitions = new $this->mappingsDefinitions[$this->type]($data);
    }

    private function setupViews()
    {
        $this->views = [];

        if ($this->definitions->has('tabs')) {
            // Create the tabs tool and add the settings to.
            $this->views[] = new TabsController($this->definitions);

            foreach ($this->views[0]->getTabIds() as $id) {
                $content = new SettingsController($this->definitions, $id);

                $this->views[0]->addTabContent($id, $content);
            }
        } else {
            $this->views[] = new SettingsController($this->definitions);
        }
    }

}
