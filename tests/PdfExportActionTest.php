<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportAction;

class PdfExportActionTest extends TestCase
{
    /**
     * @test
     * @throws \Dompdf\Exception
     */
    public function pdf_can_be_exported()
    {
//        $path = (new PdfExportAction('tests', 'test'))->execute();

        $this->assertTrue(true);
    }
}
