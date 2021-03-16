<?php


namespace Sfneal\ViewExport\Support;


use Dompdf\Exception;
use Illuminate\Support\Facades\Bus;
use Sfneal\Queueables\AbstractJob;

abstract class Renderer extends AbstractJob
{
    /**
     * @var string PDF content (either a rendered View or HTML string)
     */
    protected $content;

    /**
     * @var string|null AWS S3 path to upload PDF to after render (if provided)
     */
    protected $uploadPath;

    /**
     * Renderer constructor.
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
    }

    /**
     * Render the content to a exportable object.
     *
     * @throws Exception
     * @return object
     */
    abstract protected function render(): object;

    /**
     * Retrieve in an Exporter instance created from the $exportable.
     *
     * @param $exportable
     * @return Exporter
     */
    abstract protected function exporter($exportable): Exporter;

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
     * Load renderable content to an Exporter instance and render the output.
     *
     *  - storing output in a property avoids potentially calling expensive 'output()' method multiple times
     *
     * @return Exporter
     * @throws Exception
     */
    public function handle(): Exporter
    {
        // Render the PDF
        $exportable = $this->render();

        // Instantiate the Exporter
        return $this->export($exportable);
    }

    /**
     * Create & return an Exporter instance.
     *
     * @param $exportable
     * @return Exporter
     */
    private function export($exportable): Exporter
    {
        // Initialize the PdfExporter
        $exporter = $this->exporter($exportable);

        // Upload after rendering if an upload path was provided
        if ($this->uploadPath) {
            $exporter->upload($this->uploadPath);
        }

        // Return a PdfExporter
        return $exporter;
    }
}
