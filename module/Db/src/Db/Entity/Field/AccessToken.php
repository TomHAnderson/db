<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait AccessToken
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "accessToken"})
     * @Form\Options({"label": "Singly Access Token"})
     */
    protected $accessToken;

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($value)
    {
        $this->accessToken = $value;
        return $this;
    }
}
