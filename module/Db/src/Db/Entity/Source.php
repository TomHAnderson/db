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
    use Field\Id;
    use Field\Name;
    use Field\Mbid;
    use Field\Format;
    use Field\Note;
    use Field\Content;
    use Field\MediaSizeCompressed;
    use Field\MediaSizeUncompressed;
    use Field\DiscCountWav;
    use Field\DiscCountShn;
    use Field\CreatedAt;
    use Field\CirculatedAt;

    use Field\Performance;

    use Relation\Links;
    use Relation\Comments;
    use Relation\UserPerformances;
    use Relation\WantedBy;
    use Relation\Checksums;

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
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'mbid' => $this->getMbid(),
            'format' => $this->getFormat(),
            'note' => $this->getNote(),
            'content' => $this->getContent(),
            'mediaSizeCompressed' => $this->getMediaSizeCompressed(),
            'mediaSizeUnCompressed' => $this->getMediaSizeUnCompressed(),
            'discCountWav' => $this->getDiscCountWav(),
            'discCountShn' => $this->getDiscCountShn(),
            'createdAt' => $this->getCreatedAt(),
            'circulatedAt' => $this->getCirculatedAt(),

            'performance' => $this->getPerformance(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setFormat(isset($data['format']) ? $data['format']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setContent(isset($data['content']) ? $data['content']: null);
        $this->setMediaSizeCompressed(isset($data['mediaSizeCompressed']) ? $data['mediaSizeCompressed']: null);
        $this->setMediaSizeUncompressed(isset($data['mediaSizeUncompressed']) ? $data['mediaSizeUncompressed']: null);
        $this->setDiscCountWav(isset($data['discCountWav']) ? $data['discCountWav']: null);
        $this->setDiscCountShn(isset($data['discCountShn']) ? $data['discCountShn']: null);
        $this->setCirculatedAt(isset($data['circulatedAt']) ? $data['circulatedAt']: null);

        $this->setPerformance(isset($data['performance']) ? $data['performance']: null);
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

