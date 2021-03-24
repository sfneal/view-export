<?php

namespace Sfneal\ViewExport\Pdf;

use Illuminate\Contracts\View\View;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;
use Sfneal\ViewExport\Support\Adapters\ExportService;
use Sfneal\ViewExport\Support\Interfaces\FromHtml;
use Sfneal\ViewModels\AbstractViewModel;

class PdfExportService extends ExportService implements FromHtml
{
    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @return PdfRenderer
     */
    public static function fromView(View $view): PdfRenderer
    {
        return new PdfRenderer($view->render());
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
     * Provide an HTML path or URL to build the PDF from.
     *
     * @param string $path
     * @return PdfRenderer
     */
    public static function fromHtmlFile(string $path): PdfRenderer
    {
        return new PdfRenderer(file_get_contents($path));
    }
}
