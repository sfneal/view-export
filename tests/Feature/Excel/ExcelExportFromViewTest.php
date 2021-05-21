<?php

namespace Sfneal\ViewExport\Tests\Feature\Excel;

use Sfneal\ViewExport\Excel\ExcelExportService;
use Sfneal\ViewExport\Tests\Assets\ViewModels\TestViewModel;

class ExcelExportFromViewTest extends ExcelTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = ExcelExportService::fromView(view('table', [
            'data' => (new TestViewModel())->data(),
        ]));
    }
}
