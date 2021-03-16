<?php

namespace Sfneal\ViewExport\Pdf;

use Illuminate\Contracts\View\View;
use Sfneal\ViewExport\Pdf\Utils\Renderer;
use Sfneal\ViewModels\AbstractViewModel;

class PdfExportService
{
    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromView(View $view, string $uploadPath = null): Renderer
    {
        return new Renderer($view->render(), $uploadPath);
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
     * Provide an HTML path or URL to build the PDF from.
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
