<?php

namespace Sfneal\ViewExport\Support\Interfaces;

interface Downloadable
{
    /**
     * Download the exported view using the clients browser.
     *
     * @param string $filename
     * @return void|mixed
     */
    public function download(string $filename);
}
