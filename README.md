db.etree.org & etreedb.org
==========================

Introduction
------------
db.etree.org is a setlist database.  
etreedb.org is a database of shows owned by users of the sites.  
Both sites run on this same codebase.


Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies 

    curl -s https://getcomposer.org/installer | php

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/TomHAnderson/db.git
    cd db
    php composer.phar install

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/TomHAnderson/db/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Virtual Host
------------
To run a virtual host for db.etree.org run `php -S localhost:8080` from the public directory.


Install
-------
Create a local db database

Copy ~/config/autoload/local.php.dist to ~/config/autoload/local.php and edit it relpacing any '' with the appropriate value.

Browse to http://localhost:8080 and follow the installation
