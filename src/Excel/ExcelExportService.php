<?php

namespace Sfneal\ViewExport\Excel;

use Illuminate\Contracts\View\View;
use Sfneal\ViewExport\Excel\Utils\ExcelRenderer;
use Sfneal\ViewExport\Support\Adapters\ExportService;
use Sfneal\ViewModels\AbstractViewModel;

class ExcelExportService extends ExportService
{
    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @return ExcelRenderer
     */
    public static function fromView(View $view): ExcelRenderer
    {
        return new ExcelRenderer($view);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @return ExcelRenderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel): ExcelRenderer
    {
        return new ExcelRenderer(view($viewModel->view, $viewModel->toArray()));
    }
}
