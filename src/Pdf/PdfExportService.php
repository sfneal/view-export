<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
use Dompdf\Options;
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
     * @param Options|null $options
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromView(View $view, Options $options = null): PdfExporter
    {
        return new PdfExporter($view, $options);
    }

    /**
     * Create a view to build the PDF from.
     *
     * @param string $viewName
     * @param array $viewData
     * @param Options|null $options
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromViewData(string $viewName, array $viewData = [], Options $options = null): PdfExporter
    {
        return new PdfExporter(view($viewName, $viewData), $options);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param Options|null $options
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromViewModel(AbstractViewModel $viewModel, Options $options = null): PdfExporter
    {
        return new PdfExporter($viewModel->renderNoCache(), $options);
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @param Options|null $options
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromHtml(string $html, Options $options = null): PdfExporter
    {
        return new PdfExporter($html, $options);
    }

    /**
     * Provide an HTML path to build the PDF from.
     *
     * @param string $path
     * @param Options|null $options
     * @return PdfExporter
     * @throws Exception
     */
    public static function fromHtmlPath(string $path, Options $options = null): PdfExporter
    {
        return new PdfExporter(file_get_contents($path), $options);
    }
}
