<?php

namespace Concrete\Package\Ht7C5Base;

use \Concrete\Core\Application\Application;
use \Concrete\Core\Asset\AssetList;
use \Concrete\Core\Foundation\Service\ProviderList;
use \Concrete\Core\Package\Package;
use \Concrete\Core\Package\PackageService;
use \Concrete\Core\User\Group\Group;
use \Concrete\Package\Ht7C5Base\ServiceProvider;

defined('C5_EXECUTE') or die('Access Denied.');

class Controller extends Package
{

    protected $appVersionRequired = '8.5';
    protected $pkgAutoloaderMapCoreExtensions = true;
    protected $pkgHandle = 'ht7_c5_base';
    protected $pkgVersion = '0.1.0';

    /**
     * @var \Concrete\Core\Entity\Package
     */
    private $pkg;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        // On installation, this one will be null, but parent::install() will
        // return the current package entity.
        $this->pkg = $app->make(PackageService::class)
                ->getByHandle($this->pkgHandle);
    }

    public function getPackageDescription()
    {
        return tc(
                'ht7_c5_base',
                'Ht7 Starter package which installs some new dashboard pages and more.'
        );
    }

    public function getPackageName()
    {
        return tc('ht7_c5_base', 'Ht7 c5 Starter');
    }

    public function install()
    {
        // Install the current package and create the defined db entities.
        $this->pkg = parent::install();
        // Create all pages through the content XML.
        $this->installContentFile('install.xml');
        // Make sure the package helper can be accessed by later installation
        // process' of this package.
        $this->registerServices();
        // If the path uses "-" to separate words and the filename
        // uses "_", the cFilename on the Pages table is empty.
        // Therefor we need to update this field.
        $this->fixFilenames();

        $this->installUserGroups();
    }

    public function on_start()
    {
        $this->setupAutoloader();
        $this->registerAssets();
        $this->registerServices();
    }

    /**
     * Make sure the c5 knows the the filenames belonging to the paths defined
     * by this package.
     */
    private function fixFilenames()
    {
        $this->app->make('helper/ht7/file/namefixer')
                ->fixFilenames('/dashboard/ht7', $this->pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        // Create all missing pages through the content XML.
        $this->installContentFile('install.xml');
    }

    private function installUserGroups()
    {
        $gName = tc('ht7_c5_base-group_name', 'ht7');

        if (!is_object(Group::getByName($gName))) {
            Group::add(
                    $gName,
                    tc('ht7_c5_base-group_name', 'Base Group for ht7 applications.'),
                    false,
                    $this->pkg
            );
        }
    }

    private function registerAssets()
    {
        $al = AssetList::getInstance();

        $al->register(
                'css',
                'ht7-widgets/status-toggle',
                'css/ht7.widgets.statustoggle.css',
                ['version' => '0.0.1', 'minify' => true, 'combine' => true],
                $this
        );
        $al->register(
                'css',
                'ht7-widgets/body-overlay',
                'css/ht7.widgets.bodyoverlay.css',
                ['version' => '0.0.1', 'minify' => true, 'combine' => true],
                $this
        );
        $al->register(
                'javascript',
                'ht7-widgets/body-overlay',
                'js/ht7.widgets.bodyoverlay.js',
                ['version' => '0.0.1', 'minify' => true, 'combine' => true],
                $this
        );
        $al->register(
                'javascript',
                'ht7-widgets/concrete5',
                'js/ht7.widgets.c5.js',
                ['version' => '0.0.1', 'minify' => true, 'combine' => true],
                $this
        );
        $al->register(
                'javascript',
                'ht7-extenders',
                'js/ht7.extenders.js',
                ['version' => '0.0.1', 'minify' => true, 'combine' => true],
                $this
        );

        $al->registerGroup(
                'ht7-widgets/body-overlay',
                [
                    ['css', 'ht7-widgets/body-overlay'],
                    ['javascript', 'ht7-widgets/body-overlay']
                ]
        );
    }

    /**
     * Register the package services, register the package specific ErrorHandler.
     */
    private function registerServices()
    {
        $list = new ProviderList($this->app);
        $list->registerProvider(ServiceProvider::class);
    }

    private function setupAutoloader()
    {
        if (file_exists($this->getPackagePath() . '/vendor')) {
            // Only for development to make sure the package dependencies are
            // accessable.
            require_once $this->getPackagePath() . '/vendor/autoload.php';
        }
    }

}
