<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    , Zend\View\Model\ViewModel
    ;

final class ListPerformances extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($performances)
    {
        if (!sizeof($performances)) return '';

        $view = $this->getServiceLocator()->getServiceLocator()->get('View');
        $model = new ViewModel();
        $model->setTemplate('db-etree-org/helper/list-performances.phtml');
        $model->setVariable('performances', $performances);
        $model->setOption('has_parent', true);
        return $view->render($model);
    }
}