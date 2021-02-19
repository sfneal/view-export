<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;

class PdfExportServiceTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function fromView()
    {
        $exporter = PdfExportService::fromView(view('test'));

        $this->assertInstanceOf(PdfExporter::class, $exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function fromViewData()
    {
        $exporter = PdfExportService::fromViewData('test', ['string'=>"Here's a string!"]);

        $this->assertInstanceOf(PdfExporter::class, $exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function fromHtml()
    {
        $exporter = PdfExportService::fromHtml(file_get_contents(base_path('tests/resources/html/test.html')));

        $this->assertInstanceOf(PdfExporter::class, $exporter);
    }

    /**
     * @test
     * @throws Exception
     */
    public function fromHtmlPath()
    {
        $exporter = PdfExportService::fromHtmlPath(base_path('tests/resources/html/test.html'));

        $this->assertInstanceOf(PdfExporter::class, $exporter);
    }
}
