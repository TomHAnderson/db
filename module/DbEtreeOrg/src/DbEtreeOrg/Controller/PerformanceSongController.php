<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\PerformanceSong as PerformanceSongEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class PerformanceSongController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performanceSong = $em->getRepository('Db\Entity\PerformanceSong')->find($id);

        if (!$performanceSong)
            throw new \Exception("Performance Song $id not found");

        return array(
            'performanceSong' => $performanceSong
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performanceSong = new PerformanceSongEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSong);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSet = $em->getRepository('Db\Entity\PerformanceSet')->find($id);

        $song = null;

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSong->getInputFilter());

            $songId = $this->getRequest()->getPost()->get('song_id');
            if ($songId) $song = $em->getRepository('Db\Entity\Song')->find($songId);

            if ($song and $form->isValid()) {
                $data = $form->getData();
                $performanceSong->exchangeArray($form->getData());
                $performanceSong->setPerformanceSet($performanceSet);
                $performanceSong->setSong($song);
                $performanceSong->setSort(99999);

                $em->persist($performanceSong);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performance-set/edit?id=' . $performanceSet->getId());
            }
        }

        return array(
            'form' => $form,
            'performanceSet' => $performanceSet,
        );
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSong = $em->getRepository('Db\Entity\PerformanceSong')->find($id);

        if (!$performanceSong)
            throw new \Exception("Performance Song $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSong);
        $form->setData($performanceSong->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSong->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performanceSong->exchangeArray($form->getData());

                $songId = $this->getRequest()->getPost()->get('song_id');
                $song = $em->getRepository('Db\Entity\Song')->find($songId);
                $performanceSong->setSong($song);

                $em->persist($song);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performance-song/detail?id=' . $performanceSong->getId());
            }
        }

        return array(
            'form' => $form,
            'performanceSong' => $performanceSong,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSong = $em->getRepository('Db\Entity\PerformanceSong')->find($id);

        if (!$performanceSong)
            return $this->plugin('redirect')->toUrl('/');

        $performanceSetId = $performanceSong->getPerformanceSet()->getId();
        $em->remove($performanceSong);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/performance-set/detail?id=' . $performanceSetId);
    }
}
