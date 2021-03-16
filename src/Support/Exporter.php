<?php

namespace Sfneal\ViewExport\Support;

use Sfneal\Helpers\Aws\S3\S3;

abstract class Exporter
{
    /**
     * @var string|null AWS S3 file path
     */
    protected $path;

    /**
     * @var string|null AWS S3 file URL
     */
    protected $url;

    /**
     * @var string|null
     */
    protected $output;

    /**
     * Upload a rendered PDF to an AWS S3 file store.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self
    {
        $this->path = $path;
        $this->url = (new S3($path))->upload_raw($this->output());

        return $this;
    }

    /**
     * Retrieve the PDF's output.
     *
     * @return string
     */
    public function output(): string
    {
        return $this->output;
    }

    /**
     * Retrieve the PDF's AWS S3 path.
     *
     * @return string|null
     */
    public function path(): ?string
    {
        return $this->path;
    }

    /**
     * Retrieve the PDF's AWS S3 url.
     *
     * @return string|null
     */
    public function url(): ?string
    {
        return $this->url;
    }
}
