<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Venue as VenueEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class CommentController extends AbstractActionController
{
    public function createAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if (!$auth->hasIdentity())
            throw new \Exception('User is not authenticated');

        $id = $this->getRequest()->getPost()->get('id');
        $entityName = $this->getRequest()->getPost()->get('entityName');
        $returnUrl = $this->getRequest()->getPost()->get('returnUrl');

        $note = $this->getRequest()->getPost()->get('note');
        if (!$note)
            return $this->plugin('redirect')->toUrl($returnUrl);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $referenceName = join('', array_slice(explode('\\', $entityName), -1));
        $reference = $em->getRepository($entityName)->find($id);
        if (!$reference)
            return $this->plugin('redirect')->toUrl($returnUrl);

        $setMethod = 'set' . $referenceName;
        $entityClass = $entityName . 'Comment';

        $comment = new $entityClass();
        $comment->$setMethod($reference);
        $comment->setRating((int)$this->getRequest()->getPost()->get('rating'));
        $comment->setNote($note);
        $comment->setUser($auth->getIdentity());
        $comment->setCreatedAt(new \DateTime());

        $em->persist($comment);
        $em->flush();

        return $this->plugin('redirect')->toUrl($returnUrl);
    }

    public function deleteAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if (!$auth->hasIdentity())
            throw new \Exception('User is not authenticated');

        $id = $this->getRequest()->getQuery()->get('id');
        $entityName = $this->getRequest()->getQuery()->get('entityName');
        $returnUrl = $this->getRequest()->getQuery()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $comment = $em->getRepository($entityName)->find($id);
        if (!$comment)
            return $this->plugin('redirect')->toUrl($returnUrl);

        if ($comment->getUser() == $auth->getIdentity()) {
            $em->remove($comment);
            $em->flush();
            return $this->plugin('redirect')->toUrl($returnUrl);
        }

        die('User does not own this comment');
    }
/*
    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            throw new \Exception('User is not authenticated');

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $id = $this->getRequest()->getQuery()->get('id');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);

        if (!$venue)
            throw new \Exception("Venue $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);
        $form->setData($venue->getArrayCopy());

        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id' => 'submit',
                'type'  => 'submit',
                'value' => 'Submit',
            ),
        ));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($venue->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $venue->exchangeArray($form->getData());

                $em->persist($venue);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/venue/detail?id=' . $venue->getId());
            }
        }

        return array(
            'form' => $form,
            'venue' => $venue,
        );
    }

*/
}
