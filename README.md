
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

