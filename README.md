
Tsugi PHP Modules
=================

This is a number of different modules, originally distributed as part of the
main Tsugi repository.  In order to reduce the main repository to be an 
adimistration, configuration, and developer console, these modules 
were pulled out.

Simple Configuration
--------------------

First check out and configure the Tsugi Console:

    https://github.com/csev/tsugi

Then check this repository into the mod folder as follows:

    cd tsugi
    git clone https://github.com/csev/tsugi-php-mod mod

Then make sure that the "mod" flder is included in the `config.php`
for Tsugi so that the databases will be auto-created and the modules
in this folder will be auto-discovered.

    $CFG->tool_folders = array("admin", "mod",  ... );

Advanced Configuration
----------------------

If you don't want these tools be be run as a sub-folder within the 
tsugi folder, you can configure the `config.php` using the instructions
for a the sample single module:

    https://github.com/csev/tsugi-php-module

Multiple Repositories
---------------------

We are moving some of the modules into their own repositories - they 
are maintained here for historical purposes for installations that have
hard-coded links to precise tool paths.  Here are the folders and their
actual repositoyies:

    grades       https://github.com/tsugitools/grades
    peer-grade   https://github.com/tsugitools/peer-grade

Make sure to commit these changes in the actual repositories and then
pull the modules in here using the following commands

    git subtree pull --prefix=grades https://github.com/tsugitools/grades master
    git push origin master

The initial setup of the subtree folder uses the following command:

    git subtree add --prefix=grades https://github.com/tsugitools/grades master

Obsolete Versions
-----------------

Some of the code that was historically in this repository has moved.  Some of
the folders have been deleted here - others are here for archival purposes
for a while

* php-intro is now moved into the mod folder of https://github.com/csev/php-intro/
* sql-intro The MySQL part of this module is now in https://github.com/csev/php-intro/
eventually the SQLite versions of the autograder will move to pythonlearn
* intro-html5 Is now in https://github.com/cvanlent/intro-html5

References
----------

[1] https://help.github.com/articles/splitting-a-subfolder-out-into-a-new-repository/

