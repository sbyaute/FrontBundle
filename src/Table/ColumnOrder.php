<?php

namespace Sbyaute\FrontBundle\Table;

class ColumnOrder
{
    /**
     * @var string
     */
    private $columnName;

    /**
     * @var bool
     */
    private $ascending;

    public function __construct(string $columnName, bool $ascending)
    {
        $this->columnName = $columnName;
        $this->ascending = $ascending;
    }

    public function getColumnName(): string
    {
        return $this->columnName;
    }

    public function setColumnName(string $columnName): void
    {
        $this->columnName = $columnName;
    }

    public function isAscending(): bool
    {
        return $this->ascending;
    }

    public function setAscending(bool $ascending): void
    {
        $this->ascending = $ascending;
    }
}
