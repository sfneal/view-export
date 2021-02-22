<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Sfneal\Helpers\Strings\StringHelpers;
use Sfneal\Queueables\AbstractJob;

class Renderer extends AbstractJob
{
    /**
     * @var View|string PDF content (either a View or HTML string)
     */
    private $content;

    /**
     * @var string|null AWS S3 path to upload PDF to after render (if provided)
     */
    private $uploadPath;

    /**
     * @var Options
     */
    public $options;

    /**
     * @var Metadata
     */
    public $metadata;

    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * PdfExporter constructor.
     *
     * - $content can be a View or HTML file contents
     *
     * @param View|string $content
     * @param string|null $uploadPath
     */
    public function __construct($content, string $uploadPath = null)
    {
        // Content of the PDF
        $this->content = $content;

        // Upload PDF after rendering (defaults to false)
        $this->uploadPath = $uploadPath;

        // Declare PDF options (use DefaultOptions) if none provided
        $this->options = new DefaultOptions();

        // Instantiate Metadata
        $this->metadata = new Metadata();
    }

    /**
     * Load PDF content to the Dompdf instance and render the output.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return Exporter
     * @throws Exception
     */
    public function handle(): Exporter
    {
        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Add metadata
        $this->applyMetadata();

        // Load content
        $this->loadContent();

        // Render the PDF
        $this->pdf->render();

        // Initialize the PdfExporter
        $exporter = new Exporter($this->pdf);

        // Upload after rendering if an upload path was provided
        if ($this->uploadPath) {
            $exporter->upload($this->uploadPath);
        }

        // Return a PdfExporter
        return $exporter;
    }

    /**
     * Add Metadata to the PDF.
     *
     * @return bool
     */
    private function applyMetadata(): bool
    {
        // Add Metadata if the array isn't empty
        if ($hasMetadata = ! empty($this->metadata->get())) {
            foreach ($this->metadata->get() as $key => $value) {
                $this->pdf->add_info($key, $value);
            }
        }

        return $hasMetadata;
    }

    /**
     * Load content into the Dompdf instance.
     *
     * @throws Exception
     */
    private function loadContent(): void
    {
        // Create local HTML file path
        $localHTML = StringHelpers::joinPaths($this->options->getRootDir(), uniqid().'.html');

        // Store View (or HTML) as HTML file within Dompdf root
        touch($localHTML);
        file_put_contents($localHTML, $this->content);

        // Load HTML
        $this->pdf->loadHtmlFile($localHTML);

        // Remove temp HTML file
        unlink($localHTML);
    }
}
