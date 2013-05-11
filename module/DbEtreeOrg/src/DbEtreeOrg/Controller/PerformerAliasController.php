<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\PerformerAlias as PerformerAliasEntity
    ;

class PerformerAliasController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/performer-alias');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performerAlias = $em->getRepository('Db\Entity\PerformerAlias')->find($id);

        if (!$performerAlias)
            throw new \Exception("PerformerAlias $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('performerAlias', $performerAlias->getId());

        return array(
            'performerAlias' => $performerAlias
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performerAlias = new PerformerAliasEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerAlias);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerAlias->exchangeArray($form->getData());
                $performerAlias->setPerformer($performer);

                $em->persist($performerAlias);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('performerAlias', $performerAlias->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('performer_id', $performer->getId());
        return $viewModel;

    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerAlias = $em->getRepository('Db\Entity\PerformerAlias')->find($id);

        if (!$performerAlias)
            throw new \Exception("PerformerAlias $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerAlias);
        $form->setData($performerAlias->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('performerAlias', $performerAlias->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerAlias->exchangeArray($form->getData());

                $em->persist($performerAlias);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $performerAlias->getId());
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerAlias = $em->getRepository('Db\Entity\PerformerAlias')->find($id);
        if (!$performerAlias)
            return $this->plugin('redirect')->toUrl('/');

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('performerAlias', $performerAlias->getId());

        $performer = $performerAlias->getPerformer();

        $em->remove($performerAlias);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
    }
}
