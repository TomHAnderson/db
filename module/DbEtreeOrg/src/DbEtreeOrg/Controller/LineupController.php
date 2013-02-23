<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\Lineup as LineupEntity
    ;

class LineupController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/lineup');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);

        if (!$lineup)
            throw new \Exception("Lineup $id not found");

        if (!isset($_SESSION['lineups']['latest'])) $_SESSION['lineups']['latest'] = array();
        if (in_array($lineup->getId(), $_SESSION['lineups']['latest'])) {
            unset($_SESSION['lineups']['latest'][array_search($lineup->getId(), $_SESSION['lineups']['latest'])]);
        }
        if (!isset($_SESSION['lineups']['latest'])) $_SESSION['lineups']['latest'] = array();
        array_unshift($_SESSION['lineups']['latest'], $lineup->getId());
        $_SESSION['lineups']['latest'] = array_slice($_SESSION['lineups']['latest'], 0, 10);

        return array(
            'lineup' => $lineup
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $lineup = new LineupEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($lineup);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $band = $em->getRepository('Db\Entity\Band')->find($id);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($lineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $lineup->exchangeArray($form->getData());
                $lineup->setBand($band);

                $em->persist($lineup);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/lineup/detail?id=' . $lineup->getId());
            }
        }

        return array(
            'form' => $form,
            'band' => $band,
        );
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);

        if (!$lineup)
            throw new \Exception("Lineup $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($lineup);
        $form->setData($lineup->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($lineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $lineup->exchangeArray($form->getData());

                $em->persist($lineup);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/lineup/detail?id=' . $lineup->getId());
            }
        }

        return array(
            'form' => $form,
            'lineup' => $lineup,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);
        if (!$lineup)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($lineup->getAliases())
            and !sizeof($lineup->getLineups())
            and !sizeof($lineup->getPerformances())
            and !sizeof($lineup->getLinks())
            and !sizeof($lineup->getComments()))
        {
            $em->remove($lineup);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function addPerformerAction()
    {
        $id = $this->getRequest()->getPost()->get('id');
        $performerId = $this->getRequest()->getPost()->get('performer_id');
        $returnUrl = $this->getRequest()->getPost()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);
        $performer = $em->getRepository('Db\Entity\Performer')->find($performerId);


        $lineup->getPerformers()->add($performer);
        $performer->getLineups()->add($lineup);

        $em->flush();

        return $this->plugin('redirect')->toUrl($returnUrl);
    }

    public function removePerformerAction()
    {
        $id = $this->getRequest()->getPost()->get('id');
        $performerId = $this->getRequest()->getPost()->get('performer_id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);
        $performer = $em->getRepository('Db\Entity\Performer')->find($performerId);

        $lineup->getPerformers()->removeElement($performer);
        $performer->getLineups()->removeElement($lineup);

        $em->flush();

        return $this->plugin('redirect')->toUrl('/lineup/detail?id=' . $id);
    }
}
