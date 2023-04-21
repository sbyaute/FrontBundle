<?php

namespace Sbyaute\FrontBundle\Table;

interface QueryInterface
{
    public function getSearch(): ?string;

    public function getLimit(): ?int;

    public function getOffset(): ?int;

    /**
     * @return ColumnOrder[]
     */
    public function getColumnOrders(): array;

    /**
     * @return ColumnFilter[]
     */
    public function getColumnFilters(): array;

    public function hasAdditionalParameters(string $key): bool;

    /**
     * @throw \DomainException
     *
     * @return mixed
     */
    public function getAdditionalParameters(string $key);
}
