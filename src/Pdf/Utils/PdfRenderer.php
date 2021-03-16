<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;
use Illuminate\Support\Facades\Bus;
use Sfneal\Helpers\Strings\StringHelpers;
use Sfneal\Queueables\AbstractJob;

class PdfRenderer extends AbstractJob
{
    /**
     * @var string PDF content (either a rendered View or HTML string)
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
     * @param string $content
     * @param string|null $uploadPath
     */
    public function __construct(string $content, string $uploadPath = null)
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
     * Dispatch this renderer instance to the Job queue without having to construct it statically.
     *
     * @return mixed
     */
    public function handleJob()
    {
        return Bus::dispatch($this);
    }

    /**
     * Load PDF content to the Dompdf instance and render the output.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return PdfExporter
     * @throws Exception
     */
    public function handle(): PdfExporter
    {
        // Instantiate dompdf
        $this->pdf = new Dompdf($this->options);

        // Add metadata
        $this->applyMetadata();

        // Load content
        $this->loadContent();

        // Render the PDF
        $this->pdf->render();

        // Instantiate the Exporter
        return $this->export($this->pdf);
    }

    /**
     * Create & return an Exporter instance.
     *
     * @param $exportable
     * @return PdfExporter
     */
    private function export($exportable): PdfExporter
    {
        // Initialize the PdfExporter
        $exporter = new PdfExporter($exportable);

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
}
