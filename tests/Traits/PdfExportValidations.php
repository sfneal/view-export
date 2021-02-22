<?php

namespace Sfneal\ViewExport\Tests\Traits;

use Dompdf\Exception;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;

trait PdfExportValidations
{
    /**
     * @var PdfExporter
     */
    private $exporter;

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(PdfExporter::class, $this->exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_output()
    {
        // Render the PDF
        $this->exporter->render();

        // Execute assertions
        $this->assertNull($this->exporter->getPath());
        $this->assertNull($this->exporter->getUrl());
        $this->assertIsString($this->exporter->getOutput());
        $this->assertTrue(LaravelHelpers::isBinary($this->exporter->getOutput()));
    }
}
