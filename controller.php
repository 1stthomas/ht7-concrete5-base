<?php

namespace Concrete\Package\Ht7Concrete5Base;

use \Concrete\Core\Application\Application;
use \Concrete\Core\Asset\AssetList;
use \Concrete\Core\File\Filesystem;
use \Concrete\Core\Foundation\Service\ProviderList;
use \Concrete\Core\Package\Package;
use \Concrete\Core\Package\PackageService;
use \Concrete\Package\Ht7Concrete5Base\ServiceProvider;

class Controller extends Package
{

    protected $appVersionRequired = '8.5';
    protected $pkgAutoloaderMapCoreExtensions = true;
    protected $pkgHandle = 'ht7_concrete5_base';
    protected $pkgVersion = '0.0.1';

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
        return tc('ht7_concrete5_base', 'Ht7 Starter package which installs some new dashboard pages and more.');
    }

    public function getPackageName()
    {
        return tc('ht7_concrete5_base', 'Ht7 c5 Starter');
    }

    public function install()
    {
        // Install the current package and create the defined db entities.
        $this->pkg = parent::install();
        // Create all pages through the content XML.
        $this->installContentFile('install.xml');
        // Make sure the package helper can be accessed.
        $this->registerServices();
        // If the path uses "-" to separate words and the filename
        // uses "_", the cFilename on the Pages table is empty.
        // Therefor we need to update this field.
        $this->fixFilenames();
    }

    public function on_start()
    {
        $this->registerAssets();
        $this->registerServices();
        $this->registerRoutes();
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

    private function registerAssets()
    {

    }

    /**
     * Register all routes defined in config/paths.php.
     *
     * This method let the route helper compose an array which can be used by
     * calling <code>Route::registerMultiple($routesArray)</code>.
     *
     */
    public function registerRoutes()
    {

    }

    /**
     * Removes e.g. all single pages coming from this package. If the remove
     * DB tables setting was activated, all package database tables will also
     * be removed.
     */
    public function uninstall()
    {
        parent::uninstall();

//        $request = Request::getInstance();
//
//        if ($request->request->get('remove-db-tables')) {
//            $db = Database::connection();
//            $db->query('SET FOREIGN_KEY_CHECKS=0');
//            $db->query('DROP TABLE MeschCmProfessionalGroups');
//            $db->query('SET FOREIGN_KEY_CHECKS=1');
//        }
    }

    public function upgrade()
    {
        parent::upgrade();

        // Create all missing pages through the content XML.
        $this->installContentFile('install.xml');
    }

    /**
     * Register the package services, register the package specific ErrorHandler.
     */
    private function registerServices()
    {
        $list = new ProviderList($this->app);
        $list->registerProvider(ServiceProvider::class);
    }

}
