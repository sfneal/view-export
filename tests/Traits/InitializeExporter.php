<?php


namespace Sfneal\ViewExport\Tests\Traits;


use Sfneal\ViewExport\Pdf\Utils\PdfExporter;

trait InitializeExporter
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
}
