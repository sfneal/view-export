<?php

namespace Sfneal\ViewExport\Excel\Utils;

use Sfneal\ViewExport\Excel\Exports\ExcelViewExport;
use Sfneal\ViewExport\Support\Exporter;
use Sfneal\ViewExport\Support\Renderer;

class ExcelRenderer extends Renderer
{
    /**
     * @var string
     */
    private $excelViewClass = ExcelViewExport::class;

    /**
     * Set the ExcelView class to be used to render the Excel file.
     *
     * @param string $viewClass
     * @return $this
     */
    public function setExcelView(string $viewClass): self
    {
        $this->excelViewClass = $viewClass;

        return $this;
    }

    /**
     * Render the content to a exportable object.
     *
     * @return object
     */
    protected function render(): object
    {
        return new $this->excelViewClass($this->content);
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
