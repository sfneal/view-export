<?php

namespace Sfneal\ViewExport\Support;

use Illuminate\Support\Facades\Storage;
use Sfneal\Helpers\Aws\S3\S3;

class Exporter
{
    // todo: add ability to store locally
    // todo: fix docstrings to not be pdf specific

    /**
     * @var string|null local file path
     */
    protected $localPath;

    /**
     * @var string|null AWS S3 file path
     */
    protected $uploadPath;

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
        $this->uploadPath = $path;

        // todo: add use of Storage
        $this->url = (new S3($path))->upload_raw($this->output());

        return $this;
    }

    /**
     * Store a rendered PDF on the local file system.
     *
     * @param string $storagePath
     * @return $this
     */
    public function store(string $storagePath): self
    {
        $this->localPath = $storagePath;
        Storage::put($storagePath, $this->output());

        return $this;
    }

    /**
     * Retrieve the PDF's output.
     *
     * @return string|null
     */
    public function output(): ?string
    {
        return $this->output;
    }

    /**
     * Retrieve the PDF's AWS S3 path if available or the local file path.
     *
     * @return string|null
     */
    public function path(): ?string
    {
        return $this->uploadPath() ?? $this->localPath();
    }

    /**
     * Retrieve the PDF's AWS S3 path.
     *
     * @return string|null
     */
    public function uploadPath(): ?string
    {
        return $this->uploadPath;
    }

    /**
     * Retrieve the PDF's local file path.
     *
     * @return string|null
     */
    public function localPath(): ?string
    {
        return $this->localPath;
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
