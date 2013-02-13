<?php

namespace Db\Model;
use Db\Model\AbstractModel
    ;

final class User extends AbstractModel
{
    public function getAuthenticatedUser()
    {
        $authService = $this->getServiceManager()->get('zfcuser_auth_service');

        if ($authService->hasIdentity()) {
            return $authService->getIdentity();
        }

        return null;
    }
}