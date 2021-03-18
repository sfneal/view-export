<?php


namespace Sfneal\ViewExport\Excel;


use Illuminate\Contracts\View\View;
use Sfneal\ViewExport\Excel\Utils\ExcelRenderer;
use Sfneal\ViewExport\Support\ExportService;
use Sfneal\ViewModels\AbstractViewModel;

class ExcelExportService extends ExportService
{

    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @param string $uploadPath
     * @return ExcelRenderer
     */
    public static function fromView(View $view, string $uploadPath): ExcelRenderer
    {
        return new ExcelRenderer($view->render(), $uploadPath);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param string $uploadPath
     * @return ExcelRenderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath): ExcelRenderer
    {
        return new ExcelRenderer($viewModel->renderNoCache(), $uploadPath);
    }
}
