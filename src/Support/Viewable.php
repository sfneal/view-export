<?php

namespace Sfneal\ViewExport\Support;

interface Viewable
{
    /**
     * View the exported view in the clients browser.
     *
     * @param string $filename
     * @return void
     */
    public function view(string $filename): void;
}
