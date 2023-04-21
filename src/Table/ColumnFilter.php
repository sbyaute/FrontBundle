<?php

namespace Sbyaute\FrontBundle\Table;

class ColumnFilter
{
    /**
     * @var string
     */
    private $columnName;

    /**
     * @var mixed
     */
    private $filterValue;

    /**
     * @var array
     */
    private $additionalCriteria;

    /**
     * @param mixed $filterValue
     */
    public function __construct(string $columnName, $filterValue, array $additionalCriteria = [])
    {
        $this->columnName = $columnName;
        $this->filterValue = $filterValue;
        $this->additionalCriteria = $additionalCriteria;
    }

    public function getColumnName(): string
    {
        return $this->columnName;
    }

    public function setColumnName(string $columnName): void
    {
        $this->columnName = $columnName;
    }

    public function getFilterValue()
    {
        return $this->filterValue;
    }

    public function setFilterValue($filterValue): void
    {
        $this->filterValue = $filterValue;
    }

    public function getAdditionalCriteria(): array
    {
        return $this->additionalCriteria;
    }

    public function setAdditionalCriteria(array $additionalCriteria): void
    {
        $this->additionalCriteria = $additionalCriteria;
    }
}
