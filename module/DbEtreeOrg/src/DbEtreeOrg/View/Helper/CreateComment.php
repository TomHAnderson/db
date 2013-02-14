<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    ;

final class CreateComment extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($id, $entityName, $returnUrl)
    {
        if (!$this->getServiceLocator()->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return '<a href="/user/login">Login to comment</a>';

        return <<<EOT

        <h4>Create comment</h4>

        <div class="row">

            <div class="span1">
                Rating
            </div>

            <div class="span11">

                <span class="rating">
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="span1">
                Comment
            </div>

            <div class="span11">
                <form method="post" action="/comment/create">
                    <input type="hidden" name="id" value="{$id}">
                    <input type="hidden" name="entityName" value="{$entityName}">
                    <input type="hidden" name="returnUrl" value="{$returnUrl}">
                    <textarea name="note"></textarea>
                    <br>
                    <input type="submit" value="Submit">
                </form>
            </div>

        </div>

EOT;
    }
}