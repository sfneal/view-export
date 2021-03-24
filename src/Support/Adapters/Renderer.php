<?php

namespace Sfneal\ViewExport\Support\Adapters;

use Illuminate\Support\Facades\Bus;
use Sfneal\Queueables\AbstractJob;
use Sfneal\ViewExport\Support\Interfaces\Uploadable;

abstract class Renderer extends AbstractJob implements Uploadable
{
    /**
     * @var mixed Renderable content
     */
    protected $content;

    /**
     * @var string|null AWS S3 path to upload a file to after render (if provided)
     */
    protected $uploadPath;

    /**
     * Renderer constructor.
     *
     * - $content can be a View or HTML file contents
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        // Content of the PDF
        $this->content = $content;
    }

    /**
     * Set a path to upload the Exportable to after it's been rendered.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self
    {
        $this->uploadPath = $path;

        return $this;
    }

    /**
     * Render the content to a exportable object.
     *
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
     * @return Exporter|mixed
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

        // todo: add storing?

        // Return a PdfExporter
        return $exporter;
    }
}
