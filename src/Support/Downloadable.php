<?php

namespace Sfneal\ViewExport\Support;

interface Downloadable
{
    /**
     * Download the exported view using the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function download(string $filename): void;
}
