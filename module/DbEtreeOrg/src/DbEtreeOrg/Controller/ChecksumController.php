<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Checksum as ChecksumEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class ChecksumController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/source');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $checksum = $em->getRepository('Db\Entity\Checksum')->find($id);

        if (!$checksum)
            throw new \Exception("Checksum $id not found");

        return array(
            'checksum' => $checksum
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $checksum = new ChecksumEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($checksum);

        $id = $this->getRequest()->getQuery()->get('id');
        $source = $em->getRepository('Db\Entity\Source')->find($id);

        if (!$source)
            throw new \Exception("Source $id not found");

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($checksum->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $checksum->exchangeArray($form->getData());
                $checksum->setSource($source);

                $em->persist($checksum);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('source', $source);
        return $viewModel;
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $checksum = $em->getRepository('Db\Entity\Checksum')->find($id);

        if (!$checksum)
            throw new \Exception("Checksum $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($checksum);
        $form->setData($checksum->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($checksum->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $checksum->exchangeArray($form->getData());

                $em->persist($checksum);
                $em->flush();

                die();
            }
        }


        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('checksum', $checksum);
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $checksum = $em->getRepository('Db\Entity\Checksum')->find($id);
        if (!$checksum)
            return $this->plugin('redirect')->toUrl('/');

#        if (!sizeof($venue->getPerformances())
#            and !sizeof($venue->getVenueGroups())
#            and !sizeof($venue->getLinks())
#            and !sizeof($venue->getComments()))
#        {
        $sourceId = $checksum->getSource()->getId();
        $em->remove($checksum);
        $em->flush();
#        }

        return $this->plugin('redirect')->toUrl('/source/detail?id=' . $sourceId);
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $query = $filterNormalize(trim($query));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venues = $em->getRepository('Db\Entity\Venue')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20);

        $return = array();
        $i = 0;
        foreach ($venues as $venue) {
            if (++$i > 25) break;
            $return[] = $venue->getArrayCopy();
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('venues', $return);

        return $jsonModel;
    }
}
