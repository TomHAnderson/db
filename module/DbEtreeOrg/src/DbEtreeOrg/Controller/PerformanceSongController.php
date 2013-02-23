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
        $song = $em->getRepository('Db\Entity\Song')->find($id);

        if (!$song)
            throw new \Exception("Performance Set $id not found");

        if (!isset($_SESSION['songs']['latest'])) $_SESSION['songs']['latest'] = array();
        if (in_array($song->getId(), $_SESSION['songs']['latest'])) {
            unset($_SESSION['songs']['latest'][array_search($song->getId(), $_SESSION['songs']['latest'])]);
        }
        array_unshift($_SESSION['songs']['latest'], $song->getId());
        $_SESSION['songs']['latest'] = array_slice($_SESSION['songs']['latest'], 0, 10);

        return array(
            'song' => $song
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

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSong->getInputFilter());

            $songId = $this->getRequest()->getPost()->get('song_id');
            $song = $em->getRepository('Db\Entity\Song')->find($songId);

            if ($song and $form->isValid()) {
                $data = $form->getData();
                $performanceSong->exchangeArray($form->getData());
                $performanceSong->setPerformanceSet($performanceSet);
                $performanceSong->setSong($song);

                $em->persist($performanceSong);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performance-set/edit?id=' . $performanceSet->getId());
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $song = $em->getRepository('Db\Entity\Song')->find($id);

        if (!$song)
            throw new \Exception("Performance Set $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($song);
        $form->setData($song->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($song->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $song->exchangeArray($form->getData());
                $bandId = $this->getRequest()->getPost()->get('band_id');
                if ($bandId) {
                    $band = $em->getRepository('Db\Entity\Band')->find($bandId);
                    $song->setBand($band);
                }

                $em->persist($song);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/song/detail?id=' . $song->getId());
            }
        }

        return array(
            'form' => $form,
            'song' => $song,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);
        if (!$venue)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($venue->getPerformances())
            and !sizeof($venue->getVenueGroups())
            and !sizeof($venue->getLinks())
            and !sizeof($venue->getComments()))
        {
            $em->remove($venue);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
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
            $return[] = array(
                'value' => $venue->getId(),
                'label' => $venue->getName(),
            );
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('venues', $return);

        return $jsonModel;
    }
}
