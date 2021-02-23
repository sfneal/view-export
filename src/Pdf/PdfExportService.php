<?php

namespace Sfneal\ViewExport\Pdf;

use Illuminate\Contracts\View\View;
use Sfneal\ViewExport\Pdf\Utils\Renderer;
use Sfneal\ViewModels\AbstractViewModel;

class PdfExportService
{
    // todo: add ability to pass urls to export

    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromView(View $view, string $uploadPath = null): Renderer
    {
        return new Renderer($view, $uploadPath);
    }

    /**
     * Create a view to build the PDF from.
     *
     * // todo: remove this method?
     *
     * @param string $viewName
     * @param array $viewData
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromViewData(string $viewName, array $viewData = [], string $uploadPath = null): Renderer
    {
        return new Renderer(view($viewName, $viewData), $uploadPath);
    }

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath = null): Renderer
    {
        return new Renderer($viewModel->renderNoCache(), $uploadPath);
    }

    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromHtml(string $html, string $uploadPath = null): Renderer
    {
        return new Renderer($html, $uploadPath);
    }

    /**
     * Provide an HTML path to build the PDF from.
     *
     * @param string $path
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromHtmlFile(string $path, string $uploadPath = null): Renderer
    {
        return new Renderer(file_get_contents($path), $uploadPath);
    }
}
