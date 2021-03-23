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
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromView(View $view, string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer($view->render(), $uploadPath);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer($viewModel->renderNoCache(), $uploadPath);
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromHtml(string $html, string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer($html, $uploadPath);
    }

    /**
     * Provide an HTML path or URL to build the PDF from.
     *
     * @param string $path
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromHtmlFile(string $path, string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer(file_get_contents($path), $uploadPath);
    }
}
