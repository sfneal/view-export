<?php

namespace Sfneal\ViewExport\Tests\Excel;

use Sfneal\ViewExport\Excel\ExcelExportService;
use Sfneal\ViewExport\Tests\Assets\ViewModels\TestViewModel;

class ExcelExportFromViewModelTest extends ExcelTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = ExcelExportService::fromViewModel(new TestViewModel('table'));
    }
}
