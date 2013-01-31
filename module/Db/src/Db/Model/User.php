<?php

namespace Db\Model;

use Db\Model\AbstractEntityModel;
use Zend\InputFilter\InputFilter;

final class User extends AbstractEntityModel
{
    use \Db\Entity\Field\DisplayName
        , \Db\Entity\Field\Username
        , \Db\Entity\Field\Email
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\IsPublic
        ;

    public function getDefaultSort()
    {
        return array('displayName' => 'asc');
    }

    public function getAuthenticatedUser()
    {
        $auth = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');

        $user = null;
        if ($auth->hasIdentity()) {
            $user = $this->find($auth->getIdentity());
        }

        return $user;
    }

    public function getInputFilter($entity = null)
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputDisplayName($inputFilter));
        $inputFilter->add($this->inputFilterInputUsername($inputFilter));
        $inputFilter->add($this->inputFilterInputEmail($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));
        $inputFilter->add($this->inputFilterInputIsPublic($inputFilter));

        return $inputFilter;
    }
}