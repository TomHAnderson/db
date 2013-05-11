<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\BandAlias as BandAliasEntity
    ;

class BandAliasController extends AbstractActionController
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
        $bandAlias = $em->getRepository('Db\Entity\BandAlias')->find($id);

        if (!$bandAlias)
            throw new \Exception("Band Alias $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        return array(
            'bandAlias' => $bandAlias
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $bandAlias = new BandAliasEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($bandAlias);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $band = $em->getRepository('Db\Entity\Band')->find($id);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($bandAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $bandAlias->exchangeArray($form->getData());
                $bandAlias->setBand($band);

                $em->persist($bandAlias);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('bands', $bandAlias->getBand()->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('band', $band);
        return $viewModel;

    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $bandAlias = $em->getRepository('Db\Entity\bandAlias')->find($id);

        if (!$bandAlias)
            throw new \Exception("bandAlias $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($bandAlias);
        $form->setData($bandAlias->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($bandAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $bandAlias->exchangeArray($form->getData());

                $em->persist($bandAlias);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('bandAlias', $bandAlias);
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $bandAlias = $em->getRepository('Db\Entity\BandAlias')->find($id);
        if (!$bandAlias)
            return $this->plugin('redirect')->toUrl('/');

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        $band = $bandAlias->getBand();

        $em->remove($bandAlias);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/band/detail?id=' . $band->getId());
    }
}
