<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;

abstract class PdfTestCase extends TestCase
{
    /**
     * @var PdfRenderer
     */
    protected $renderer;

    /**
     * Execute PDfExport assertions.
     * @param PdfExporter $exporter
     */
    private function executeAssertions(PdfExporter $exporter): void
    {
        $this->assertNull($exporter->path());
        $this->assertNull($exporter->url());
        $this->assertIsString($exporter->output());
        $this->assertTrue(LaravelHelpers::isBinary($exporter->output()));
    }

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(PdfRenderer::class, $this->renderer);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function pdf_can_be_stored()
    {
        $stored = $this->renderer
            ->handle()
            ->store(storage_path('pdfs/output-' . random_int(1000, 9999) . '.pdf'));
        $localPath = $stored->localPath();

        $this->assertIsString($localPath);
        $this->assertIsString(Storage::path($localPath));
        $this->assertTrue(Storage::exists($localPath));
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

    /** @test */
    public function validate_queueable_renderer_with_queue()
    {
        // Enable queue faking
        Queue::fake();

        // Assert that no jobs were pushed...
        Queue::assertNothingPushed();

        // Dispatch the first job...
        Queue::push($this->renderer);

        // Assert a job was pushed...
        Queue::assertPushed(PdfRenderer::class, 1);
    }

    /** @test */
    public function validate_queueable_non_static()
    {
        // Enable queue faking
        Bus::fake();

        // Assert that no jobs were pushed...
        Bus::assertNotDispatched(PdfRenderer::class);

        // Dispatch the first job...
        $this->renderer->handleJob();

        // Assert a job was pushed...
        Bus::assertDispatched(PdfRenderer::class);
    }
}
