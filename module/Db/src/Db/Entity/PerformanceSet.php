<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performanceSet")
 */
class PerformanceSet extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Content
        , \Db\Entity\Field\Sort
        , \Db\Entity\Field\Performance
    ;

    use \Db\Entity\Relation\PerformanceSongs
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'sort' => $this->getSort(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setContent(isset($data['content']) ? $data['content']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: null);
    }
}

