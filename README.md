db.etree.org & etreedb.org
==========================

Introduction
------------
db.etree.org is a setlist database.  
etreedb.org is a database of shows owned by users of the sites.  
Both sites run on this same codebase.


Installation
------------
    cd my/project/dir
    git clone git://github.com/TomHAnderson/db.git
    cd db
    php composer.phar install

Virtual Host
------------
To run a virtual host for db.etree.org run `php -S localhost:8080` from the public directory.


Install
-------
Create a local db database

Copy ~/config/autoload/local.php.dist to ~/config/autoload/local.php and edit it relpacing any '' with the appropriate value.

Browse to http://localhost:8080 and follow the installation
