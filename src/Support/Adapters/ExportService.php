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
     * @return Renderer
     */
    abstract public static function fromView(View $view): Renderer;

    /**
     * Provide a view to build the export from.
     *
     * @param AbstractViewModel $viewModel
     * @return Renderer
     */
    abstract public static function fromViewModel(AbstractViewModel $viewModel): Renderer;
}
