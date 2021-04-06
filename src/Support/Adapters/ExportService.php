<?php

namespace Sfneal\ViewExport\Support\Adapters;

use Illuminate\Contracts\View\View;
use Sfneal\ViewModels\ViewModel;

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
     * @param ViewModel $viewModel
     * @return Renderer
     */
    abstract public static function fromViewModel(ViewModel $viewModel): Renderer;
}
