<?php

namespace Sfneal\ViewExport\Tests\Traits;

use Dompdf\Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\ViewExport\Pdf\Utils\Exporter;
use Sfneal\ViewExport\Pdf\Utils\Renderer;

trait PdfExportValidations
{
    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * Execute PDfExport assertions.
     * @param Exporter $exporter
     */
    private function executeAssertions(Exporter $exporter): void
    {
        $this->assertNull($exporter->getPath());
        $this->assertNull($exporter->getUrl());
        $this->assertIsString($exporter->getOutput());
        $this->assertTrue(LaravelHelpers::isBinary($exporter->getOutput()));
    }

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(Renderer::class, $this->renderer);
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

        // Assert a job was pushed twice...
        Queue::assertPushed(Renderer::class, 1);
    }

    /** @test */
    public function validate_queueable_non_static()
    {
        // Enable queue faking
        Bus::fake();

        // Assert that no jobs were pushed...
        Bus::assertNotDispatched(Renderer::class);

        // Dispatch the first job...
        $this->renderer->dispatch();

        // Assert a job was pushed twice...
        Bus::assertDispatched(Renderer::class);
    }
}
