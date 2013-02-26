<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\Band as BandEntity
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class BandController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/band');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $band = $em->getRepository('Db\Entity\Band')->find($id);

        if (!$band)
            throw new \Exception("Band $id not found");

        if (!isset($_SESSION['bands']['latest'])) $_SESSION['bands']['latest'] = array();
        if (in_array($band->getId(), $_SESSION['bands']['latest'])) {
            unset($_SESSION['bands']['latest'][array_search($band->getId(), $_SESSION['bands']['latest'])]);
        }
        if (!isset($_SESSION['bands']['latest'])) $_SESSION['bands']['latest'] = array();
        array_unshift($_SESSION['bands']['latest'], $band->getId());
        $_SESSION['bands']['latest'] = array_slice($_SESSION['bands']['latest'], 0, 10);

        return array(
            'band' => $band
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $band = new BandEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($band);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($band->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $band->exchangeArray($form->getData());

                $em->persist($band);
                $em->flush();

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
        $band = $em->getRepository('Db\Entity\Band')->find($id);

        if (!$band)
            throw new \Exception("Band $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($band);
        $form->setData($band->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($band->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $band->exchangeArray($form->getData());

                $em->persist($band);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/band/detail?id=' . $band->getId());
            }
        }

        return array(
            'form' => $form,
            'band' => $band,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $band = $em->getRepository('Db\Entity\Band')->find($id);
        if (!$band)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($band->getAliases())
            and !sizeof($band->getLineups())
            and !sizeof($band->getPerformances())
            and !sizeof($band->getLinks())
            and !sizeof($band->getComments()))
        {
            $em->remove($band);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function searchJsonAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $query = $this->getRequest()->getQuery()->get('q');
        $filterNormalize = new Normalize();
        $query = $filterNormalize(trim($query));

        $bands = $em->getRepository('Db\Entity\Band')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20);

        $return = array();
        $i = 0;
        foreach ($bands as $band) {
            if (++$i > 25) break;
            $return[] = array(
                'value' => $band->getId(),
                'label' => $band->getName(),
            );
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('bands', $return);

        return $jsonModel;
    }
}
