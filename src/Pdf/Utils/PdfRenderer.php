<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Sfneal\Helpers\Strings\StringHelpers;

class PdfRenderer
{
    // todo: make dispatchable

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

        // Instantiate Metadata
        $this->metadata = new Metadata();

        // Content of the PDF
        $this->content = $content;
    }

    /**
     * Load PDF content to the Dompdf instance and render the output.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return PdfExporter
     * @throws Exception
     */
    public function render(): PdfExporter
    {
        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Add metadata
        $this->applyMetadata();

        // Load content
        $this->loadContent();

        // Render the PDF
        $this->pdf->render();

        // Return a PdfExporter
        return new PdfExporter($this->pdf);
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
