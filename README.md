www.etreedb.org
==========================

Introduction
------------
etreedb.org is the next generation of db.etree.org

Installation
------------
    git clone git://github.com/etreedb/db
    copy ~/public/.htaccess.dist to ~/public/.htaccess
    php composer.phar install

db uses Doctrine 2 for database abstraction.  Supported drivers are listed here:
https://github.com/doctrine/dbal/tree/master/lib/Doctrine/DBAL/Driver

Copy ~/config/autoload/local.php.dist to ~/config/autoload/local.php and edit it relpacing any '' with the appropriate values.

Run a virtual host for db.etree.org from the public directory.
    php -S localhost:8080

Run vendor/bin/doctrine-module and install the database schema.

Browse to http://localhost:8080 
