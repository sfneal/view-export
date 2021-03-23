<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Sfneal\ViewExport\Support\Downloadable;
use Sfneal\ViewExport\Support\Exporter;
use Sfneal\ViewExport\Support\Viewable;

class PdfExporter extends Exporter implements Viewable, Downloadable
{
    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * Exporter constructor.
     *
     * - $content can be a View or HTML file contents
     *
     * @param Dompdf $pdf
     */
    public function __construct(Dompdf $pdf)
    {
        $this->pdf = $pdf;

        // Store output to a property to avoid retrieving twice
        $this->output = $this->pdf->output();
    }

    /**
     * View the PDF in the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function view(string $filename = 'output.pdf'): void
    {
        $this->pdf->stream($filename, ['Attachment' => false]);
    }

    /**
     * Download the PDF using the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function download(string $filename = 'output.pdf'): void
    {
        $this->pdf->stream($filename, ['Attachment' => true]);
    }
}
