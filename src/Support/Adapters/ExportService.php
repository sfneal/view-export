<?php

namespace Sfneal\ViewExport\Support\Adapters;

use Illuminate\Contracts\View\View;
use Sfneal\ViewModels\AbstractViewModel;

abstract class ExportService
{
    /**
     * Provide a view to build the export from.
     *
     * @param View $view
     * @param string|null $uploadPath
     * @return Renderer
     */
    abstract public static function fromView(View $view, string $uploadPath = null): Renderer;

    /**
     * Provide a view to build the export from.
     *
     * @param AbstractViewModel $viewModel
     * @param string|null $uploadPath
     * @return Renderer
     */
    abstract public static function fromViewModel(AbstractViewModel $viewModel, string $uploadPath = null): Renderer;
}
