<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\Performer as PerformerEntity
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class PerformerController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performers = $em->getRepository('Db\Entity\Performer')->findBy(array(), array('name' => 'ASC'));

        return array(
            'performers' => $performers,
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/performer');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('performers', $performer->getId());

        return array(
            'performer' => $performer
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performer = new PerformerEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performer);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performer->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performer->exchangeArray($form->getData());

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $em->persist($performer);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('performers', $performer->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performer);
        $form->setData($performer->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('performers', $performer->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performer->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performer->exchangeArray($form->getData());

                $em->persist($performer);
                $em->flush();

                die();
            }
        }


        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('performer', $performer);
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);
        if (!$performer)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($performer->getAliases())
            and !sizeof($performer->getLineups())
            and !sizeof($performer->getPerformances())
            and !sizeof($performer->getLinks())
            and !sizeof($performer->getComments()))
        {
            $menu = $this->getServiceLocator()->get('menu');
            $menu->removeRecent('performers', $performer->getId());

            $em->remove($performer);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $queryArray = array();
        $queryArray['nameNormalize'] = '%' . $query . '%';

        $performers = $em->getRepository('Db\Entity\Performer')->findLike($queryArray);

        $aliases = $em->getRepository('Db\Entity\PerformerAlias')->findLike($queryArray, array(), 20);

        $return = array();
        $i = 0;

        foreach ($performers as $performer) {
            if (++$i > 10) break;
            $return[] = $performer->getArrayCopy();
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('performers', $return);

        return $jsonModel;
    }
}
