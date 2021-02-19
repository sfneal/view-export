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
}
