<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $keenio = $this->getServiceLocator()->get('serviceKeenIO_project');
        $collection = $keenio->getCollection('test');
        $collection->send(array(
            'type' => 'test',
            'page' => 'index',
        ));


        $jambase = $this->getServiceLocator()->get('serviceJambase');

        print_r($jambase->search(array(
            'name' => 'fillmore',
            'zipcode' => 94132
        )));

        return new ViewModel();
    }
}
