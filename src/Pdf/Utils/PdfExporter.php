<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Sfneal\Helpers\Aws\S3\S3;

class PdfExporter
{
    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * @var string|null AWS S3 file path
     */
    private $path;

    /**
     * @var string|null AWS S3 file URL
     */
    private $url;

    /**
     * @var string|null
     */
    private $output;

    /**
     * PdfExporter constructor.
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
     * Upload a rendered PDF to an AWS S3 file store.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self
    {
        $this->path = $path;
        $this->url = (new S3($path))->upload_raw($this->getOutput());

        return $this;
    }

    /**
     * View the PDF in the clients browser.
     *
     * @param string $filename
     */
    public function view(string $filename = 'output.pdf')
    {
        $this->pdf->stream($filename, ['Attachment' => false]);
    }

    /**
     * Download the PDF using the clients browser.
     *
     * @param string $filename
     */
    public function download(string $filename = 'output.pdf')
    {
        $this->pdf->stream($filename, ['Attachment' => true]);
    }

    /**
     * Retrieve the PDF's output.
     *
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * Retrieve the PDF's AWS S3 path.
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Retrieve the PDF's AWS S3 url.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}
