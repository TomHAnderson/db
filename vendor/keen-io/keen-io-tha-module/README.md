Keen IO Zend Framework 2 Module
===============================

This ZF2 module adds dependency injection and a service manager alias
for the Project service class.

Installation
------------
  1. edit `composer.json` file with following contents:
```json
    "require": {
        "keen-io/keen-io-tha": "dev-master",
        "keen-io/keen-io-tha-module": "dev-master"
    }
```

  2. install composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  3. run `php composer.phar install`
  4. copy config/keen-io.module.local.php.dist to your ZF2 installation's config/autoload directory and rename to keen-io.module.local.php
  5. Edit keen-io.module.local.php with your API KEY and PROJECT ID
  6. Edit your ```config/application.php``` and add ```KeenIO``` to your modules array.

Use 
---
```php
    $project = $this->getServiceLocator()->get('serviceKeenIO_project');

    $collection = $project->getCollection('example');
    $collection->send(array(
        'type' => 'test',
        'format' => 'zf2',
    ));
```
