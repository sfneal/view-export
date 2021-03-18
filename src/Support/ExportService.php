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
     * @param string $uploadPath
     * @return Renderer
     */
    abstract public static function fromView(View $view, string $uploadPath): Renderer;

    /**
     * Provide a view to build the PDF from.
     *
     * @param AbstractViewModel $viewModel
     * @param string $uploadPath
     * @return Renderer
     */
    abstract public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath): Renderer;
}
