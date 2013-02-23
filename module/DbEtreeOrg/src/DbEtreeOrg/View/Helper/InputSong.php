<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    , Zend\View\Model\ViewModel
    ;

final class InputSong extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($song = '', $label = 'Song')
    {
        $view = $this->getServiceLocator()->getServiceLocator()->get('View');
        $model = new ViewModel();
        $model->setTemplate('db-etree-org/helper/input-song.phtml');
        $model->setVariable('song', $song);
        $model->setVariable('label', $label);
        $model->setOption('has_parent', true);
        return $view->render($model);
    }
}