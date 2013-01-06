<?php
namespace Install;

use Zend\ModuleManager\ModuleManager,
    Zend\Mvc\MvcEvent,
    Zend\EventManager\EventManager,
    Zend\EventManager\StaticEventManager,
    Doctrine\ORM\Tools\SchemaTool,
    Doctrine\ORM\Tools\SchemaValidator
    ;

class Module
{
    private $eventManager;

    public function init(ModuleManager $manager) {
        $this->setEventManager($manager->getEventManager());
    }

    public function setEventManager(EventManager $eventManager) {
        $this->eventManager = $eventManager;
        return $this;
    }

    public function getEventManager() {
        return StaticEventManager::getInstance();
        return $this->eventManager;
    }

    public function onBootstrap($e) {
        $app = $e->getApplication();
        $di = $app->getServiceManager();

        $em = $di->get('doctrine.entitymanager.orm_default');

        self::validateSchema($em);

        $conn = $em->getConnection();
        $sql = "SELECT * FROM User";
        try {

            $stmt = $conn->query($sql);

            // Installed; check for escapeHtml updates
            $this->getEventManager()->attach(
                array('Zend\Mvc\Application'),
                MvcEvent::EVENT_ROUTE,
                array($this, 'syncronizeDatabase')
            );

            return; // Application is installed

        } catch (\Doctrine\escapeHtmlAL\escapeHtmlALException $e) {
            switch ($e->getPrevious()->getCode()) {
                case '42S02':  // Table or view not found; this is what we expect
                    if ($app->getRequest()->getQuery()->get('install')) {
                        // The last event in this list must stop propogation
                        $this->getEventManager()->attach(
                            array('Zend\Mvc\Application'),
                            MvcEvent::EVENT_ROUTE,
                            array($this, 'buildDatabase')
                        );
                        $this->getEventManager()->attach(
                            array('Zend\Mvc\Application'),
                            MvcEvent::EVENT_ROUTE,
                            array($this, 'setDefaults')
                        );
                    } else {
                        // Begin installation
                        $this->getEventManager()->attach(
                            array('Zend\Mvc\Application'),
                            MvcEvent::EVENT_ROUTE,
                            array($this, 'showInstall')
                        );
                    }
                    break;
                default:
                    echo '<h1>An unexpected database error has occurred while checking installation</h1>';
                    die($e->getMessage());
            }
        } catch (\Exception $e) {
            switch ($e->getCode()) {
                case 1049: // Database does not exist
                    $this->getEventManager()->attach(
                        array('Zend\Mvc\Application'),
                        MvcEvent::EVENT_ROUTE,
                        array($this, 'notifyNoDatabase')
                    );
                    break;
                default:
                    throw new \Exception('Database exception in Install Module: ' . $e->getMessage());
            }
        }
    }

    public function syncronizeDatabase($e)
    {
        $em = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
        self::validateSchema($em);
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);

        // update the database
        if (isset($_REQUEST['sync'])) $res = $tool->UpdateSchema($em->getMetadataFactory()->getAllMetadata());

        if ($res = $tool->getUpdateSchemaSql($em->getMetadataFactory()->getAllMetadata())) {

            $sql = print_r($res, true);

            $e->getTarget()->getResponse()->setContent(
            "<h1>Database Synchronization</h1>" .
            '<p>A schema change has taken place in the application which must be applied to the database using the link at the bottom of this page.</p>' .
            '<p>The following changes will be made to the databsae:</p>'

            . '<pre>'
            . $sql
            . "</pre>"
            . "<br>***************************************************************"
            . "<h1><a href=\"/?sync=true\">Synchronize Database</a></h1>");

            $e->stopPropagation();
            return $e->getTarget()->getResponse();
        }
    }

    public function notifyNoDatabase($e) {
        $response = $e->getTarget()->getResponse();
        $response->setContent('<h1>etreedb</h1>
              The database does not exist.
              Please create the database and try again.
        ');
        $e->stopPropagation();
        return $response;
    }

    /**
     * Begin the installation
     */
    public function showInstall($e) {
        $response = $e->getTarget()->getResponse();
        $response->setContent('<h1>etreedb</h1>
              etreedb thinks it is not installed because it cannot connect to your
              database.
              <br>
              <a href="/?install=1">Begin installation</a>
        ');

        $e->stopPropagation();
        return $response;
    }

    public function checkPaths($e) {
        $response = $e->getTarget()->getResponse();
        $return = '';
        $errors = array();

        // Check directories
        $checkDirs = array(
            'Session Save Path' => session_save_path(),
            'Upload Temp' => ini_get('upload_tmp_dir'),
            'Search' => __DIR__ . '/../../data/Search/',
            'Cache' => __DIR__ . '/../../data/Cache/',
            'Doctrine Proxies' => __DIR__ . '/../../data/DoctrineORMModule/Proxy'
        );
        $return .= '<style>span.fail {color: red;}</style>';
        $return .= "<h1>Application Installation Step 1 - Paths</h1><pre>";

        foreach ($checkDirs as $key => $checkDir) {
            $return .= "Testing $key Directory\n";

            // Directory testing from Smarty->testInstall();
            if (!is_dir($checkDir)) {
                $status = false;
                $message = "<span class=\"fail\">FAILED</span>: {$checkDir} is not a directory";
                $return .= $message . ".\n\n";
                $errors['compile_dir'] = $message;
            } elseif (!is_readable($checkDir)) {
                $status = false;
                $message = "<span class=\"fail\">FAILED</span>: {$checkDir} is not readable";
                $return .= $message . ".\n\n";
                $errors['compile_dir'] = $message;
            } elseif (!is_writable($checkDir)) {
                $status = false;
                $message = "<span class=\"fail\">FAILED</span>: {$checkDir} is not writable";
                $return .= $message . ".\n\n";
                $errors['compile_dir'] = $message;
            } else {
                $return .= "{$checkDir} is OK.\n\n";
            }

        }
        $return .= '</pre>
            You must fix these errors to continue.
        ';

        if ($errors) {
            echo $return;
            $e->stopPropagation();
            return $response;
        }

        return true;
    }

    /**
     * Create the database
     * This is the last step so always stop propagation
     */
    public function buildDatabase($e)
    {
        $response = $e->getTarget()->getResponse();

        try {
            $em = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');

            self::validateSchema($em);
//print_r($em->getMetadataFactory()->getAllMetadata());
            $tool = new SchemaTool($em);
            $res = $tool->createSchema($em->getMetadataFactory()->getAllMetadata());

            $response = $e->getTarget()->getResponse();
            $response->setContent('<a href="/">Start using etreedb</a>');

        } catch (\Exception $error) {
            print_r($error->getMessage());
        }

        return $response;
    }

    public function setDefaults($e) {

        $e->stopPropagation();
        return $e->getTarget()->getResponse();
    }

    private function generatePassword($length) {
        $i = 0;
        $pass = '' ;

        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);

        while ($i < $length) {
            $pass .= substr($chars, rand() % 33, 1);
            $i++;
        }

        return $pass;
    }

    private function validateSchema($em){

        $validator = new SchemaValidator($em);
        $errors = $validator->validateMapping();

        if (count($errors) > 0) {
            echo '<h1>Doctrine Schema Validator Errors</h1>';
            echo '<pre>';
            print_r($errors);die();
        }
    }

}
