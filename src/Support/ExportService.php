<?php

namespace Sfneal\ViewExport\Support;

use Illuminate\Contracts\View\View;
use Sfneal\ViewModels\AbstractViewModel;

abstract class ExportService
{
    /**
     * Provide a view to build the PDF from.
     *
     * @param View $view
     * @param string|null $uploadPath
     * @return Renderer
     */
    abstract public static function fromView(View $view, string $uploadPath = null): Renderer;

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param string|null $uploadPath
     * @return Renderer
     */
    abstract public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath = null): Renderer;
}
