<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;
use Sfneal\Helpers\Strings\StringHelpers;
use Sfneal\ViewExport\Support\Adapters\Renderer;

class PdfRenderer extends Renderer
{
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
     * PdfRenderer constructor.
     *
     * @param string $content
     * @param string|null $uploadPath
     */
    public function __construct(string $content, string $uploadPath = null)
    {
        // Call Parent constructor
        parent::__construct($content, $uploadPath);

        // Declare PDF options (use DefaultOptions) if none provided
        $this->options = new DefaultOptions();

        // Instantiate Metadata
        $this->metadata = new Metadata();
    }

    /**
     * Render the PDF & return a Dompdf instance.
     *
     * @return Dompdf
     * @throws Exception
     */
    protected function render(): Dompdf
    {
        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Add metadata
        $this->applyMetadata();

        // Load content
        $this->loadContent();

        // Render the PDF
        $this->pdf->render();

        // Return the PDF
        return $this->pdf;
    }

    /**
     * Initialize the Exporter.
     *
     * @param $exportable
     * @return PdfExporter
     */
    protected function exporter($exportable): PdfExporter
    {
        return new PdfExporter($exportable);
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
        // todo: implement this if it improves performance
//        $this->pdf->loadHtml($this->content);

        // Create local HTML file path
        $localHTML = StringHelpers::joinPaths($this->options->getRootDir(), uniqid().'.html');

        // Store View (or HTML) as HTML file within Dompdf root
        touch($localHTML);
        file_put_contents($localHTML, $this->content);

        // Load HTML
        $this->pdf->loadHtmlFile($localHTML);

        // Remove temp HTML file if app is NOT in 'debug' mode
        if (! config('app.debug')) {
            unlink($localHTML);
        }
    }

    /**
     * Load renderable content to an Exporter instance and render the output.
     *
     * @return PdfExporter
     */
    public function handle(): PdfExporter
    {
        return parent::handle();
    }
}
