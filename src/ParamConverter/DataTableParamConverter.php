<?php

namespace Sbyaute\FrontBundle\ParamConverter;

use Sbyaute\FrontBundle\Table\ColumnFilter;
use Sbyaute\FrontBundle\Table\ColumnOrder;
use Sbyaute\FrontBundle\Table\DataTableQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * See https://datatables.net/manual/server-side#Sent-parameters.
 */
class DataTableParamConverter implements ParamConverterInterface
{
    /**
     * @return bool
     */
    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return DataTableQuery::class === $configuration->getClass();
    }

    /**
     * @return bool
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $query = new DataTableQuery();

        $query->setOffset($this->getOffset($request));
        $query->setLimit($this->getLimit($request));
        $query->setSearch($this->getSearch($request));
        $query->setColumnOrders($this->getColumnOrders($request));
        $query->setColumnFilters($this->getColumnFilters($request));

        $draw = $this->getDraw($request);
        if (null !== $draw) {
            $query->setAdditionalParameters('draw', $draw);
        }

        $request->attributes->set($configuration->getName(), $query);

        return true;
    }

    private function getOffset(Request $request): ?int
    {
        return $request !== $request->get('start', $request) ? (int) $request->get('start') : null;
    }

    private function getLimit(Request $request): ?int
    {
        return $request !== $request->get('length', $request) ? (int) $request->get('length') : null;
    }

    private function getSearch(Request $request): ?string
    {
        $search = $request->get('search');

        if (!isset($search['value'])) {
            return null;
        }

        return (string) $search['value'];
    }

    /**
     * @return ColumnOrder[]
     */
    private function getColumnOrders(Request $request): array
    {
        $orders = [];
        foreach ($request->get('order', []) as $orderQuery) {
            if (!isset($orderQuery['column']) || !isset($orderQuery['dir'])) {
                continue;
            }

            $column = $this->getColumnQueryByIndex($request, $orderQuery['column']);

            if (!isset($column['name'])) {
                continue;
            }

            $orders[] = new ColumnOrder((string) $column['name'], 'asc' === $orderQuery['dir']);
        }

        return $orders;
    }

    private function getColumnQueryByIndex(Request $request, int $index): ?array
    {
        return $request->get('columns')[$index] ?? null;
    }

    /**
     * @return ColumnFilter[]
     */
    private function getColumnFilters(Request $request): array
    {
        $filters = [];
        foreach ($request->get('columns', []) as $columnsQuery) {
            if (!isset($columnsQuery['name']) || !strlen($columnsQuery['search']['value'])) {
                continue;
            }

            $filters[] = new ColumnFilter($columnsQuery['name'], $columnsQuery['search']['value']);
        }

        return $filters;
    }

    private function getDraw(Request $request): ?int
    {
        return $request !== $request->get('draw', $request) ? (int) $request->get('draw') : null;
    }
}
