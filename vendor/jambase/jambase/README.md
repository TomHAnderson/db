Jambase PHP Library
================================
This is a library to abstract the Jambase API 

Installation
------------
  1. edit `composer.json` file with following contents:

     ```json
     "require": {
        "jambase/jambase-tha": "dev-master"
     }
     ```
  2. install composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  3. run `php composer.phar install`

Use
---
Configure the service
```php
use Jambase\Service\Jambase;

Jambase::configure($apiKey);
```

Query the API
```php
$simpleXMLResult = Jambase::search(array('band' => 'The Band'));
```
