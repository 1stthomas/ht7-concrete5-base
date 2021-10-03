# ht7-concrete5-base - ht7_c5_base #

This is the base package for all ht7 concrete5 package. It provides the base dashboard page
architecture and some basic functionallity.

## Developer Notes ##

### Ht7 Tools ###
This package provides a simple tool to maintain dashboard pages to display and save
settings from the concrete5 file config system.

### Helper classes ###

#### PackageBase ####
This class determines the package from an instance of a class of the searched package.
Therfor no need to hardcode the package handle everywhere its needed. Simple retrive
this helper, call the related method with an instance of a class from the searched
package and get the package or its handle, depending on the called method.

This class provides also methods to gain the related package file/db config.

#### File Name Fixer ####
concrete 5 can not handle page paths with a dash ("-"). This helper can tranform page names with a "_"
into "-". Simply call:

'''php
$app->make('helper/ht7/file/namefixer')->fixFilenames('/', <pkgHandle>);
'''
to fix all page paths of the submitted package.
