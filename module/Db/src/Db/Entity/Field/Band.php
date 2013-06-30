<?php
namespace Db\Entity\Field;

use Db\Entity\Band as BandEntity;
use Workspace\Service\WorkspaceService as Workspace;
use Zend\InputFilter\InputFilter;
use Db\Filter\DoctrineEntity as DoctrineEntityFilter;

trait Band
{
    /**
     * @Form\Type("Db\Form\Element\Lookup")
     * @Form\Attributes({"type": "hidden"})
     * @Form\Attributes({"id": "band"})
     * @Form\Options({"label": "", "entity_class": "Db\Entity\Band"})
     */
    protected $band;

    public function getBand()
    {
        return Workspace::filter($this->band);
    }

    public function setBand($value)
    {
        if ($value !== null and ! $value instanceof BandEntity) {
            throw new \Exception('Catchable fatal error: Argument 1 passed to
                Db\Entity\Song::setBand() must be an instance of Db\Entity\Band or null');
        }
        $this->band = $value;

        return $this;
    }

    private function inputFilterInputBand($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'band',
            'required' => false,
            'filters' => array(
                new DoctrineEntityFilter('Db\Entity\Band')
            ),
        ));
    }
}
