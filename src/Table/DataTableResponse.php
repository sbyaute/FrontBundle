<?php

namespace Sbyaute\FrontBundle\Table;

/**
 * See https://datatables.net/manual/server-side#Returned-data.
 */
class DataTableResponse implements \JsonSerializable
{
    /**
     * @var QueryInterface
     */
    private $tableQuery;

    /**
     * @var iterable
     */
    private $data;

    /**
     * @var int
     */
    private $dataCount;

    /**
     * @var ?int
     */
    private $dataUnfilteredCount;

    /**
     * @var ?string
     */
    private $errorMessage;

    public function __construct(
        QueryInterface $tableQuery,
        iterable $data,
        int $dataCount
    ) {
        $this->tableQuery = $tableQuery;
        $this->data = $data;
        $this->dataCount = $dataCount;
    }

    public function jsonSerialize()
    {
        $data = [
            'data' => $this->data,
            'recordsFiltered' => $this->dataCount,
            'recordsTotal' => $this->dataUnfilteredCount ?? $this->dataCount, // avoid count query without filter
        ];

        if ($this->tableQuery->hasAdditionalParameters('draw')) {
            $data['draw'] = $this->tableQuery->getAdditionalParameters('draw');
        }

        if (null !== $this->errorMessage) {
            $data['error'] = $this->errorMessage;
        }

        return $data;
    }

    public function setDataUnfilteredCount(?int $dataUnfilteredCount): void
    {
        $this->dataUnfilteredCount = $dataUnfilteredCount;
    }

    public function setErrorMessage(?string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}
