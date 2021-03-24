<?php

namespace Sfneal\ViewExport\Support\Adapters;

use Illuminate\Support\Facades\Storage;
use Sfneal\ViewExport\Support\Interfaces\Storable;
use Sfneal\ViewExport\Support\Interfaces\Uploadable;

abstract class Exporter implements Uploadable, Storable
{
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
     * Upload a rendered export to an AWS S3 file store.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self
    {
        Storage::disk('s3')->put($path, $this->output());
        $this->uploadPath = $path;
        $this->url = Storage::disk('s3')->url($path);

        return $this;
    }

    /**
     * Store a rendered export on the local file system.
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
     * Retrieve the export's output.
     *
     * @return string|null
     */
    public function output(): ?string
    {
        return $this->output;
    }

    /**
     * Retrieve the export's AWS S3 path if available or the local file path.
     *
     * @return string|null
     */
    public function path(): ?string
    {
        return $this->uploadPath() ?? $this->localPath();
    }

    /**
     * Retrieve the export's AWS S3 path.
     *
     * @return string|null
     */
    public function uploadPath(): ?string
    {
        return $this->uploadPath;
    }

    /**
     * Retrieve the export's local file path.
     *
     * @return string|null
     */
    public function localPath(): ?string
    {
        return $this->localPath;
    }

    /**
     * Retrieve the export's AWS S3 url.
     *
     * @return string|null
     */
    public function url(): ?string
    {
        return $this->url;
    }
}
