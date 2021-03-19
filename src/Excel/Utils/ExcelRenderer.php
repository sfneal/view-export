<?php

namespace Sfneal\ViewExport\Excel\Utils;

use Sfneal\ViewExport\Support\Exporter;
use Sfneal\ViewExport\Support\Renderer;

class ExcelRenderer extends Renderer
{
    /**
     * Render the content to a exportable object.
     *
     * @return object
     */
    protected function render(): object
    {
        return new ExcelView($this->content);
    }

    /**
     * Retrieve in an Exporter instance created from the $exportable.
     *
     * @param $exportable
     * @return ExcelExporter
     */
    protected function exporter($exportable): ExcelExporter
    {
        return new ExcelExporter($exportable);
    }

    /**
     * Load renderable content to an Exporter instance and render the output.
     *
     * @return Exporter|ExcelExporter
     */
    public function handle(): ExcelExporter
    {
        return parent::handle();
    }
}
