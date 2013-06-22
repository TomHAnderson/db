<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("song")
 */
class Song extends AbstractEntity {
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\Lyrics;
    use Field\Note;
    use Field\Mbid;

    use Field\Band;

    use Relation\PerformanceSetSongs;
    use Relation\Links;
    use Relation\Comments;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'lyrics' => $this->getLyrics(),
            'note' => $this->getNote(),
            'band' => $this->getBand(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setLyrics(isset($data['lyrics']) ? $data['lyrics']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setBand(isset($data['band']) ? $data['band']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }

    public function getPerformances() {

        $return = new ArrayCollection();
        foreach ($this->getPerformanceSetSongs() as $performanceSetSong) {
            $return->add($performanceSetSong->getPerformanceSet()->getPerformance());
        }

        return $return;
    }
}
