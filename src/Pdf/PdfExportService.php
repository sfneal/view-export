<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Sfneal\Actions\AbstractService;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;
use Sfneal\ViewModels\AbstractViewModel;

class PdfExportService extends AbstractService
{
    // todo: add ability to pass urls to export

    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @param Options|null $options
     * @return PdfRenderer
     */
    public static function fromView(View $view, Options $options = null): PdfRenderer
    {
        return new PdfRenderer($view, $options);
    }

    /**
     * Create a view to build the PDF from.
     *
     * @param string $viewName
     * @param array $viewData
     * @param Options|null $options
     * @return PdfRenderer
     */
    public static function fromViewData(string $viewName, array $viewData = [], Options $options = null): PdfRenderer
    {
        return new PdfRenderer(view($viewName, $viewData), $options);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param Options|null $options
     * @return PdfRenderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel, Options $options = null): PdfRenderer
    {
        return new PdfRenderer($viewModel->renderNoCache(), $options);
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @param Options|null $options
     * @return PdfRenderer
     */
    public static function fromHtml(string $html, Options $options = null): PdfRenderer
    {
        return new PdfRenderer($html, $options);
    }

    /**
     * Provide an HTML path to build the PDF from.
     *
     * @param string $path
     * @param Options|null $options
     * @return PdfRenderer
     */
    public static function fromHtmlFile(string $path, Options $options = null): PdfRenderer
    {
        return new PdfRenderer(file_get_contents($path), $options);
    }
}
