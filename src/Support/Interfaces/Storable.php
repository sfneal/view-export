<?php

namespace Sfneal\ViewExport\Support\Interfaces;

interface Storable
{
    /**
     * Store a rendered export on the local file system.
     *
     * @param string $storagePath
     * @return $this
     */
    public function store(string $storagePath): self;
}
