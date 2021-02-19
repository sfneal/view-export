<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
use Illuminate\Contracts\View\View;
use Sfneal\Actions\AbstractService;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;
use Sfneal\ViewModels\AbstractViewModel;

class PdfExportService extends AbstractService
{
    // todo: add ability to pass urls to export

    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromView(View $view): PdfExporter
    {
        return new PdfExporter($view);
    }

    /**
     * Create a view to build the PDF from.
     *
     * @param string $viewName
     * @param array $viewData
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromViewData(string $viewName, array $viewData = []): PdfExporter
    {
        return new PdfExporter(view($viewName, $viewData));
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromViewModel(AbstractViewModel $viewModel): PdfExporter
    {
        return new PdfExporter($viewModel->renderNoCache());
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromHtml(string $html): PdfExporter
    {
        return new PdfExporter($html);
    }

    /**
     * Provide an HTML path to build the PDF from.
     *
     * @param string $path
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromHtmlPath(string $path): PdfExporter
    {
        return new PdfExporter(file_get_contents($path));
    }
}
