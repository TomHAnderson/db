<?php
namespace Db\Field;

use Db\Entity\Sort as SortEntity;

trait Sort
{
    protected $sort;

    public function getSort()
    {
        return $this->sort;
    }

    public function sortSort(SortEntity $value)
    {
        $this->sort = $value;
        return $this;
    }
}
