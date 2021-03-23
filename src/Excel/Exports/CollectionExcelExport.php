<?php

namespace Sfneal\ViewExport\Excel\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Sfneal\ViewExport\Support\Adapters\ExcelExport;

class CollectionExcelExport extends ExcelExport implements FromCollection
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * CollectionExcelExport constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Retrieve the Collection.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->collection;
    }
}
