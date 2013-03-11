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
        $id = $this->getRequest()->getQuery()->get('id');
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
        $viewModel->setVariable('id', $bandAlias->getId());
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $bandAlias = $em->getRepository('Db\Entity\bandAlias')->find($id);
        if (!$bandAlias)
            return $this->plugin('redirect')->toUrl('/');

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        $performer = $bandAlias->getPerformer();

        $em->remove($bandAlias);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
    }
}
