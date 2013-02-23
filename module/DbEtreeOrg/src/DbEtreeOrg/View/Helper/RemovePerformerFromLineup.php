<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    , Zend\View\Model\ViewModel
    ;

final class RemovePerformerFromLineup extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($id)
    {
        if (!$this->getServiceLocator()->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return '';

        $view = $this->getServiceLocator()->getServiceLocator()->get('View');
        $model = new ViewModel();
        $model->setTemplate('db-etree-org/helper/remove-performer-from-lineup.phtml');
        $model->setVariable('id', $id);
        $model->setOption('has_parent', true);
        return $view->render($model);
    }
}