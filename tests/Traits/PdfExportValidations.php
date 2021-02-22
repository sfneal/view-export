<?php

namespace Sfneal\ViewExport\Tests\Traits;

use Dompdf\Exception;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;

trait PdfExportValidations
{
    /**
     * @var PdfRenderer
     */
    private $renderer;

    /**
     * Execute PDfExport assertions.
     * @param PdfExporter $exporter
     */
    private function executeAssertions(PdfExporter $exporter): void
    {
        $this->assertNull($exporter->getPath());
        $this->assertNull($exporter->getUrl());
        $this->assertIsString($exporter->getOutput());
        $this->assertTrue(LaravelHelpers::isBinary($exporter->getOutput()));
    }

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(PdfRenderer::class, $this->renderer);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_standard_output()
    {
        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_output_with_metadata()
    {
        // Add metadata
        $this->renderer->metadata->add('Title', 'Test Title');

        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_landscape_output()
    {
        // todo: add checks to confirm orientation
        // Change orientation to landscape
        $this->renderer->options->setLandscape();

        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function validate_portrait_output()
    {
        // todo: add checks to confirm orientation
        // Change orientation to landscape
        $this->renderer->options->setPortrait();

        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }
}
