<?php

namespace Db\Model;

use Db\Model\AbstractModel;
use Db\Entity\User as UserEntity;
use Zend\InputFilter\InputFilter;

class User extends AbstractModel
{
    use Component\Entity
        , \Db\Field\DisplayName
        , \Db\Field\Username
        ;

    public function getEntityName() {
        return 'Db\Entity\User';
    }

    public function getDefaultSort()
    {
        return array('displayName' => 'asc');
    }

    public function create(UserEntity $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $user));

        return $user;
    }

    public function edit(UserEntity $user)
    {
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $user));

        return $user;
    }

    public function delete(UserEntity $user)
    {
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $user));
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function getAuthUser()
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

        $inputFilter->add($this->inputFilterInputDisplayName());
        $inputFilter->add($this->inputFilterInputUsername());

        return $inputFilter;
    }
}