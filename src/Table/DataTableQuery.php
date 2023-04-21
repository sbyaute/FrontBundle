<?php

namespace Sbyaute\FrontBundle\Table;

use DomainException;

class DataTableQuery implements QueryInterface
{
    /**
     * https://datatables.net/manual/server-side.
     */
    public const DRAW_PARAMETER = 'draw';

    /**
     * @var string|null
     */
    private $search;

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var int|null
     */
    private $offset;

    /**
     * @var ColumnOrder[]
     */
    private $columnOrders = [];

    /**
     * @var ColumnFilter[]
     */
    private $columnFilters = [];

    /**
     * @var array
     */
    private $additionalParameters = [];

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return ColumnOrder[]
     */
    public function getColumnOrders(): array
    {
        return $this->columnOrders;
    }

    /**
     * @param ColumnOrder[] $columnOrders
     */
    public function setColumnOrders(array $columnOrders): void
    {
        $this->columnOrders = $columnOrders;
    }

    public function addColumnOrder(ColumnOrder $columnOrder): void
    {
        $this->columnOrders[] = $columnOrder;
    }

    /**
     * @return ColumnFilter[]
     */
    public function getColumnFilters(): array
    {
        return $this->columnFilters;
    }

    /**
     * @param ColumnFilter[] $columnFilters
     */
    public function setColumnFilters(array $columnFilters): void
    {
        $this->columnFilters = $columnFilters;
    }

    public function addColumnFilter(ColumnFilter $columnFilter): void
    {
        $this->columnFilters[] = $columnFilter;
    }

    /**
     * @throw \DomainException
     *
     * @return mixed
     */
    public function getAdditionalParameters(string $key)
    {
        if (!$this->hasAdditionalParameters($key)) {
            throw new DomainException($key.' ne fait pas partie des paramètres additionnels');
        }

        return $this->additionalParameters[$key];
    }

    /**
     * @param mixed $value
     */
    public function setAdditionalParameters(string $key, $value): void
    {
        $this->additionalParameters[$key] = $value;
    }

    public function hasAdditionalParameters(string $key): bool
    {
        return isset($this->additionalParameters[$key]);
    }
}
