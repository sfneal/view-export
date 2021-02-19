<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Sfneal\Helpers\Aws\S3\S3;
use Sfneal\Helpers\Strings\StringHelpers;

class PdfExporter
{
    /**
     * @var Options
     */
    private $options;

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
     * @param View|string $content
     * @param Options|null $options
     * @throws Exception
     */
    public function __construct($content, Options $options = null)
    {
        // Declare PDF options (use DefaultOptions) if none provided
        $this->options = $options ?? new DefaultOptions();

        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Load content
        $this->loadContent($content);

        // Render the PDF
        $this->render();
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

    /**
     * Load PDF content to the Dompdf instance.
     *
     *  - $content can be a View or HTML file contents
     *
     * @param View|string $content
     * @return $this
     * @throws Exception
     */
    private function loadContent($content): self
    {
        // Create local HTML file path
        $localHTML = StringHelpers::joinPaths($this->options->getRootDir(), uniqid().'.html');

        // Store View (or HTML) as HTML file within Dompdf root
        touch($localHTML);
        file_put_contents($localHTML, $content);

        // Load HTML
        $this->pdf->loadHtmlFile($localHTML);

        // Remove temp HTML file
        unlink($localHTML);

        return $this;
    }

    /**
     * Render a Dompdf & store it's output in a property.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return void
     */
    private function render(): void
    {
        $this->pdf->render();
        $this->output = $this->pdf->output();
    }
}
