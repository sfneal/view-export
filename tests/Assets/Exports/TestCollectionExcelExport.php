<?php


namespace Sfneal\ViewExport\Tests\Assets\Exports;


use Sfneal\ViewExport\Excel\Exports\CollectionExcelExport;
use Sfneal\ViewExport\Tests\Assets\ViewModels\TestViewModel;

class TestCollectionExcelExport extends CollectionExcelExport
{
    /**
     * TestCollectionExcelExport constructor.
     */
    public function __construct()
    {
        parent::__construct(collect((new TestViewModel())->data()));
    }
}
