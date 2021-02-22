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
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromView(View $view, string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer($view, $uploadPath);
    }

    /**
     * Create a view to build the PDF from.
     *
     * @param string $viewName
     * @param array $viewData
     * @param string|null $uploadPath
     * @return PdfRenderer
     */
    public static function fromViewData(string $viewName, array $viewData = [], string $uploadPath = null): PdfRenderer
    {
        return new PdfRenderer(view($viewName, $viewData), $uploadPath);
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
     * Provide an HTML path to build the PDF from.
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
