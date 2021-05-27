<?php

namespace Sfneal\ViewExport\Tests;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Sfneal\ViewExport\Excel\Utils\ExcelExporter;
use Sfneal\ViewExport\Excel\Utils\ExcelRenderer;
use Sfneal\ViewExport\Tests\Assets\Exports\TestCollectionExcelExport;
use Sfneal\ViewExport\Tests\Assets\Exports\TestViewExcelExport;

abstract class ExcelTestCase extends TestCase
{
    /**
     * @var ExcelRenderer
     */
    protected $renderer;

    /**
     * Execute PDfExport assertions.
     * @param ExcelExporter $exporter
     */
    private function executeAssertions(ExcelExporter $exporter): void
    {
        $this->assertNull($exporter->path());
        $this->assertNull($exporter->url());
        $this->assertIsString($exporter->output());
    }

    /** @test */
    public function initialize_exporter()
    {
        $this->assertInstanceOf(ExcelRenderer::class, $this->renderer);
    }

    /** @test */
    public function excel_can_be_stored()
    {
        $stored = $this->renderer
            ->handle()
            ->store('excel/output-'.random_int(1000, 9999).'.xlsx');
        $localPath = $stored->localPath();

        $this->assertIsString($localPath);
        $this->assertIsString(Storage::path($localPath));
        $this->assertTrue(Storage::exists($localPath));
    }

    /** @test */
    public function validate_standard_output()
    {
        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }

    /** @test */
    public function validate_output_with_custom_view_export()
    {
        // Add use of custom ExcelViewExport
        $this->renderer->setExcelExport(TestViewExcelExport::class);

        // Render the PDF
        $exporter = $this->renderer->handle();

        // Execute assertions
        $this->executeAssertions($exporter);
    }

    /** @test */
    public function validate_output_with_custom_collection_export()
    {
        // Add use of custom ExcelViewExport
        $this->renderer->setExcelExport(TestCollectionExcelExport::class);

        // Render the PDF
        $exporter = $this->renderer->handle()->store('excel/output-'.random_int(1000, 9999).'.xlsx');
        $localPath = $exporter->localPath();

        // Execute assertions
        $this->assertIsString($localPath);
        $this->assertIsString(Storage::path($localPath));
        $this->assertTrue(Storage::exists($localPath));
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
        Queue::assertPushed(ExcelRenderer::class, 1);
    }

    /** @test */
    public function validate_queueable_non_static()
    {
        // Enable queue faking
        Bus::fake();

        // Assert that no jobs were pushed...
        Bus::assertNotDispatched(ExcelRenderer::class);

        // Dispatch the first job...
        $this->renderer->handleJob();

        // Assert a job was pushed...
        Bus::assertDispatched(ExcelRenderer::class);
    }
}
