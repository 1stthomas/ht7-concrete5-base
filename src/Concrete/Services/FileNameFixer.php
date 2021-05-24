<?php

namespace Concrete\Package\Ht7C5Base\Services;

use \Concrete\Core\Entity\Package;
use \Concrete\Core\Page\Page;
use \Doctrine\ORM\EntityManagerInterface;

/**
 * This class fixes file names, which c5 can not resolve correctly.
 *
 * If the path uses "-" to separate words and the filename uses "_", the
 * cFilename on the Pages table is empty. Therefor this field needs to be
 * updated if there are package pages, which have a path as described.
 *
 * @author Thomas Plüss
 * @copyright (c) 2019, Thomas Plüss
 */
class FileNameFixer extends AbstractService
{

    /**
     * Make sure the c5 knows the the filenames belonging to the paths defined
     * by this package.
     *
     * @param   string  $basePath           The path of the base page to
     *                                      recursively fix their file name on
     *                                      the db.
     * @param   Package|null    $pkg        Description
     * @return  void
     */
    public function fixFilenames($basePath, Package $pkg = null)
    {
        $db = $this->app
                ->make(EntityManagerInterface::class)
                ->getConnection();
        $cBase = Page::getByPath($basePath);

        $this->recFixFilenames($cBase, $db, $pkg);
    }

    /**
     * Create the filename of the given path by changing "-" into "_" and
     * adding ".php" at the end of the string.
     *
     * @param   Page    $c
     * @return  string
     */
    private function getFilenameFromPage(Page $c)
    {
        $cPath = $c->getCollectionPath();

        if (empty($cPath)) {
            return '';
        } else {
            $cPath .= '.php';
            return str_replace('-', '_', $cPath);
        }
    }

    /**
     * Recursively fix the filename of the submitted page and its children.
     *
     * @param   Page        $c          The parent page from where the children
     *                                  must be fixed.
     * @param   \Concrete\Core\Database\Connection\Connection $db
     * @param   Package     $pkg        If a package instance is defined, only
     *                                  pages from this package will be checked
     *                                  and fixed if necessary. Otherwise all
     *                                  pages will be fixed.
     * @return  void
     */
    private function recFixFilenames(Page $c, $db, Package $pkg = null)
    {
        if (is_object($c) && $c->getCollectionID() > 1) {
            if ($pkg === null || $pkg->getPackageEntity()->getPackageID() === $pkg->getPackageID()) {
                $cID = $c->getCollectionID();
                $cFilename = $this->getFilenameFromPage($c);
                // Fix the current page.
                $db->query('UPDATE Pages SET cFilename="' . $cFilename . '" WHERE cID=' . $cID);
            }

            $children = $c->getCollectionChildren();

            foreach ($children as $child) {
                // Go one level up.
                $this->recFixFilenames($child, $db);
            }
        }
    }

}
