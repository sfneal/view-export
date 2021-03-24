<?php

namespace Sfneal\ViewExport\Support\Interfaces;

interface Uploadable
{
    /**
     * Upload a rendered export to an AWS S3 file store.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self;
}
