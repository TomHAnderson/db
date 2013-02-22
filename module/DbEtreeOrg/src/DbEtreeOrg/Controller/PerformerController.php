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
        return array(
        );
    }

    public function detailAction()
    {
        $id = $this->getRequest()->getQuery()->get('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/performer');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        if (!isset($_SESSION['performers']['latest'])) $_SESSION['performers']['latest'] = array();
        if (in_array($performer->getId(), $_SESSION['performers']['latest'])) {
            unset($_SESSION['performers']['latest'][array_search($performer->getId(), $_SESSION['performers']['latest'])]);
        }
        array_unshift($_SESSION['performers']['latest'], $performer->getId());
        $_SESSION['performers']['latest'] = array_slice($_SESSION['performers']['latest'], 0, 10);

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

                return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
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
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performer);
        $form->setData($performer->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performer->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performer->exchangeArray($form->getData());

                $em->persist($performer);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
            }
        }

        return array(
            'form' => $form,
            'performer' => $performer,
        );
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
            $em->remove($performer);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $queryLast = $filterNormalize(trim(strtok($query, ',')));
        $queryFirst = $filterNormalize(trim(strtok(',')));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $queryArray = array();
        if ($queryFirst) $queryArray['firstnameNormalize'] = '%' . $queryFirst . '%';
        if ($queryLast) $queryArray['lastnameNormalize'] = '%' . $queryLast . '%';

        if ($queryArray) $performers = $em->getRepository('Db\Entity\Performer')->findLike($queryArray);

        if (!$queryFirst and $queryLast) {
            $aliases = $em->getRepository('Db\Entity\PerformerAlias')->findLike(array(
                'nameNormalize' => $queryLast
            ), array(), 20);
        }

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
