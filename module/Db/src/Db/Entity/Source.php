<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("source")
 */
class Source extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Mbid
        , \Db\Entity\Field\Format
        , \Db\Entity\Field\Performance
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Content
        , \Db\Entity\Field\MediaSizeCompressed
        , \Db\Entity\Field\MediaSizeUncompressed
        , \Db\Entity\Field\DiscCountWav
        , \Db\Entity\Field\DiscCountShn
        , \Db\Entity\Field\CreatedAt
        , \Db\Entity\Field\CirculatedAt
        ;

    use \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\UserPerformances
        , \Db\Entity\Relation\WantedBy
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'mediaSizeCompressed' => $this->getMediaSizeCompressed(),
            'mediaSizeUnCompressed' => $this->getMediaSizeUnCompressed(),
            'discCountWav' => $this->getDiscCountWav(),
            'discCountShn' => $this->getDiscCountShn(),
            'createdAt' => $this->getCreatedAt()->format('r'),
            'circulatedAt' => $this->getCirculatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setContnet(isset($data['content']) ? $data['content']: null);
        $this->setMediaSizeCompressed(isset($data['mediaSizeCompressed']) ? $data['mediaSizeCompressed']: null);
        $this->setMediaSizeUncompressed(isset($data['mediaSizeUncompressed']) ? $data['mediaSizeUncompressed']: null);
        $this->setDiscCountWav(isset($data['discCountWav']) ? $data['discCountWav']: null);
        $this->setDiscCountShn(isset($data['discCountShn']) ? $data['discCountShn']: null);
        $this->setCirculatedAt(isset($data['circulatedAt']) ? $data['circulatedAt']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputContent($inputFilter));
        $inputFilter->add($this->inputFilterInputMediaSizeCompressed($inputFilter));
        $inputFilter->add($this->inputFilterInputMediaSizeUncompressed($inputFilter));
        $inputFilter->add($this->inputFilterInputDiscCountWav($inputFilter));
        $inputFilter->add($this->inputFilterInputDiscCountShn($inputFilter));
        $inputFilter->add($this->inputFilterInputCirculatedAt($inputFilter));

        return $inputFilter;
    }
}

