<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    , Zend\View\Model\ViewModel
    ;

final class ListComments extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($comments)
    {
        if (!sizeof($comments)) return '';

        $view = $this->getServiceLocator()->getServiceLocator()->get('View');
        $model = new ViewModel();
        $model->setTemplate('db-etree-org/helper/list-comments.phtml');
        $model->setVariable('comments', $comments);
        $model->setOption('has_parent', true);
        return $view->render($model);
    }
}