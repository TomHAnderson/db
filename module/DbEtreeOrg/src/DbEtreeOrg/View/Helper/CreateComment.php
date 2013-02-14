<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    ;

final class CreateComment extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\ServiceLocator;

    public function __invoke($entityName, $returnUrl)
    {
        return <<<EOT

        <div class="row" style="border: solid;">

            <h4>Create comment</h4>

            <div class="span2">
                Rating
            </div>

            <div class="span10">
                Comment
                <textarea name="note"></textarea>

                <input type="submit" value="Submit">
            </div>

        </div>

EOT;
    }
}