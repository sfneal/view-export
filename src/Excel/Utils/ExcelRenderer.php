<?php

namespace Sfneal\ViewExport\Excel\Utils;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Sfneal\ViewExport\Support\Renderer;

class ExcelRenderer extends Renderer implements FromView
{
    use Exportable;

    /**
     * Render the content to a exportable object.
     *
     * @return object
     */
    protected function render(): object
    {
        return $this;
    }

    /**
     * Retrieve in an Exporter instance created from the $exportable.
     *
     * @param $exportable
     * @return ExcelExporter
     */
    protected function exporter($exportable): ExcelExporter
    {
        return new ExcelExporter();
    }

    /**
     * Return a used in the Excel export.
     *
     * @return View
     */
    public function view(): View
    {
        return $this->content;
    }
}
