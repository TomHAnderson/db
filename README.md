db.etree.org & etreedb.org
==========================

Introduction
------------
db.etree.org is a setlist database.  
etreedb.org is a database of shows owned by users of the sites.  
Both sites run on this codebase.


Installation
------------
    git clone git://github.com/TomHAnderson/db
    cd db
    php composer.phar install

db uses Doctrine 2 for database abstraction.  Supported drivers are listed here:
https://github.com/doctrine/dbal/tree/master/lib/Doctrine/DBAL/Driver

Copy ~/config/autoload/local.php.dist to ~/config/autoload/local.php and edit it relpacing any '' with the appropriate values.

Run a virtual host for db.etree.org from the public directory.
    php -S localhost:8080

Browse to http://localhost:8080 and follow the installation instructions.
