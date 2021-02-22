<?php

namespace Sfneal\ViewExport\Tests\Traits;

use Dompdf\Exception;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;

trait PdfExportValidations
{
    /**
     * @var PdfRenderer
     */
    private $exporter;

    /**
     * Execute PDfExport assertions.
     */
    private function executeAssertions(): void
    {
        $this->assertNull($this->exporter->getPath());
        $this->assertNull($this->exporter->getUrl());
        $this->assertIsString($this->exporter->getOutput());
        $this->assertTrue(LaravelHelpers::isBinary($this->exporter->getOutput()));
    }

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(PdfRenderer::class, $this->exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_standard_output()
    {
        // Render the PDF
        $this->exporter->render();

        // Execute assertions
        $this->executeAssertions();
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_output_with_metadata()
    {
        // Add metadata
        $this->exporter->metadata->add('Title', 'Test Title');

        // Render the PDF
        $this->exporter->render();

        // Execute assertions
        $this->executeAssertions();
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_landscape_output()
    {
        // todo: add checks to confirm orientation
        // Change orientation to landscape
        $this->exporter->options->setLandscape();

        // Render the PDF
        $this->exporter->render();

        // Execute assertions
        $this->executeAssertions();
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_portrait_output()
    {
        // todo: add checks to confirm orientation
        // Change orientation to landscape
        $this->exporter->options->setPortrait();

        // Render the PDF
        $this->exporter->render();

        // Execute assertions
        $this->executeAssertions();
    }
}
