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
        $id = $this->getRequest()->getQuery()->get('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/performer-alias');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performerAlias = $em->getRepository('Db\Entity\PerformerAlias')->find($id);

        if (!$performerAlias)
            throw new \Exception("PerformerAlias $id not found");

        if (!isset($_SESSION['performerAlias']['latest'])) $_SESSION['performerAliass']['latest'] = array();
        if (in_array($performerAlias->getId(), $_SESSION['performerAliass']['latest'])) {
            unset($_SESSION['performerAlias']['latest'][array_search($performerAlias->getId(), $_SESSION['performerAlias']['latest'])]);
        }
        if (!$_SESSION['performerAlias']['latest']) $_SESSION['performerAlias']['latest'] = array();
        array_unshift($_SESSION['performerAlias']['latest'], $performerAlias->getId());
        $_SESSION['performerAlias']['latest'] = array_slice($_SESSION['performerAlias']['latest'], 0, 10);

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

        $id = $this->getRequest()->getPost()->get('id');
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

                return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performerAlias->getPerformer()->getId());
            }
        }

        return array(
            'form' => $form
        );
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

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerAlias->exchangeArray($form->getData());

                $em->persist($performerAlias);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performerAlias/detail?id=' . $performerAlias->getId());
            }
        }

        return array(
            'form' => $form,
            'performerAlias' => $performerAlias,
        );
    }

    public function deleteAction()
    {
        die("Once you get an alias you're stuck with it");

        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerAlias = $em->getRepository('Db\Entity\PerformerAlias')->find($id);
        if (!$performerAlias)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($performerAlias->getAliases())
            and !sizeof($performerAlias->getLineups())
            and !sizeof($performerAlias->getPerformances())
            and !sizeof($performerAlias->getLinks())
            and !sizeof($performerAlias->getComments()))
        {
            $em->remove($performerAlias);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }
}
