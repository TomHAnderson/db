<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("source")
 */
class Source extends AbstractEntity
{
    use Field\Id
        , Field\Name
        , Field\Mbid
        , Field\Format
        , Field\Performance
        , Field\Note
        , Field\Content
        , Field\MediaSizeCompressed
        , Field\MediaSizeUncompressed
        , Field\DiscCountWav
        , Field\DiscCountShn
        , Field\CreatedAt
        , Field\CirculatedAt
        ;

    use Relation\Links
        , Relation\Comments
        , Relation\UserPerformances
        , Relation\WantedBy
        , Relation\Checksums
        ;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->setCreatedAt(new \Datetime());
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'format' => $this->getFormat(),
            'note' => $this->getNote(),
            'mediaSizeCompressed' => $this->getMediaSizeCompressed(),
            'mediaSizeUnCompressed' => $this->getMediaSizeUnCompressed(),
            'discCountWav' => $this->getDiscCountWav(),
            'discCountShn' => $this->getDiscCountShn(),
            'createdAt' => $this->getCreatedAt()->format('r'),
            'circulatedAt' => $this->getCirculatedAt(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setContent(isset($data['content']) ? $data['content']: null);
        $this->setMediaSizeCompressed(isset($data['mediaSizeCompressed']) ? $data['mediaSizeCompressed']: null);
        $this->setMediaSizeUncompressed(isset($data['mediaSizeUncompressed']) ? $data['mediaSizeUncompressed']: null);
        $this->setCirculatedAt(isset($data['circulatedAt']) ? $data['circulatedAt']: null);
        $this->setFormat(isset($data['format']) ? $data['format']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputFormat($inputFilter));
        $inputFilter->add($this->inputFilterInputContent($inputFilter));

        $inputFilter->add($this->inputFilterInputMediaSizeCompressed($inputFilter));
        $inputFilter->add($this->inputFilterInputMediaSizeUncompressed($inputFilter));
        $inputFilter->add($this->inputFilterInputCirculatedAt($inputFilter));

        // Allow for null name
        $inputFilter->add($inputFilter->getFactory()->createInput(array(
            'name' => 'name',
            'required' => false,
            'validators' => array(),
        )));

        $inputFilter->add($inputFilter->getFactory()->createInput(array(
            'name' => 'note',
            'required' => true,
            'validators' => array(),
        )));

        return $inputFilter;
    }
}

