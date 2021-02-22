<?php

namespace Sfneal\ViewExport\Pdf;

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
     * @return PdfRenderer
     */
    public static function fromView(View $view): PdfRenderer
    {
        return new PdfRenderer($view);
    }

    /**
     * Create a view to build the PDF from.
     *
     * @param string $viewName
     * @param array $viewData
     * @return PdfRenderer
     */
    public static function fromViewData(string $viewName, array $viewData = []): PdfRenderer
    {
        return new PdfRenderer(view($viewName, $viewData));
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @return PdfRenderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel): PdfRenderer
    {
        return new PdfRenderer($viewModel->renderNoCache());
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @return PdfRenderer
     */
    public static function fromHtml(string $html): PdfRenderer
    {
        return new PdfRenderer($html);
    }

    /**
     * Provide an HTML path to build the PDF from.
     *
     * @param string $path
     * @return PdfRenderer
     */
    public static function fromHtmlFile(string $path): PdfRenderer
    {
        return new PdfRenderer(file_get_contents($path));
    }
}
