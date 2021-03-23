<?php

namespace Sfneal\ViewExport\Excel\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Sfneal\ViewExport\Support\Adapters\ExcelExport;

class ViewExcelExport extends ExcelExport implements FromView
{
    /**
     * @var View
     */
    private $view;

    /**
     * Excel constructor.
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Return a used in the Excel export.
     *
     * @return View
     */
    public function view(): View
    {
        return $this->view;
    }
}
