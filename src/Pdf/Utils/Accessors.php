<?php

namespace Sfneal\ViewExport\Pdf\Utils;

trait Accessors
{
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
