<?php


namespace Sfneal\ViewExport\Support;


interface Streamable
{
    /**
     * View the exported view in the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function view(string $filename): void;

    /**
     * Download the exported view using the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function download(string $filename): void;
}
