<?php

namespace Sfneal\ViewExport\Excel\Utils;

use Sfneal\ViewExport\Excel\Exports\ViewExcelExport;
use Sfneal\ViewExport\Support\Adapters\Exporter;
use Sfneal\ViewExport\Support\Adapters\Renderer;

class ExcelRenderer extends Renderer
{
    /**
     * @var string
     */
    private $excelExportClass = ViewExcelExport::class;

    /**
     * Set the `ExcelExport` class to be used to render the Excel file.
     *
     * @param string $exportClass
     * @return $this
     */
    public function setExcelExport(string $exportClass): self
    {
        $this->excelExportClass = $exportClass;

        return $this;
    }

    /**
     * Render the content to a exportable object.
     *
     * @return object
     */
    protected function render(): object
    {
        return new $this->excelExportClass($this->content);
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
