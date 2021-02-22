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
    // todo: make dispatchable
    use Accessors;

    /**
     * @var Options
     */
    public $options;

    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * @var View|string
     */
    private $content;

    /**
     * PdfExporter constructor.
     *
     * - $content can be a View or HTML file contents
     *
     * @param View|string $content
     * @param Options|null $options
     */
    public function __construct($content, Options $options = null)
    {
        // Declare PDF options (use DefaultOptions) if none provided
        $this->options = $options ?? new DefaultOptions();

        // Content of the PDF
        $this->content = $content;
    }

    /**
     * Load PDF content to the Dompdf instance and render the output.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return $this
     * @throws Exception
     */
    public function render(): self
    {
        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Create local HTML file path
        $localHTML = StringHelpers::joinPaths($this->options->getRootDir(), uniqid().'.html');

        // Store View (or HTML) as HTML file within Dompdf root
        touch($localHTML);
        file_put_contents($localHTML, $this->content);

        // Load HTML
        $this->pdf->loadHtmlFile($localHTML);

        // Remove temp HTML file
        unlink($localHTML);

        // Render the PDF
        $this->pdf->render();

        // Store output to a property to avoid retrieving twice
        $this->output = $this->pdf->output();

        return $this;
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
}
