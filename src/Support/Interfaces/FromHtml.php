<?php

namespace Sfneal\ViewExport\Support\Interfaces;

use Sfneal\ViewExport\Support\Adapters\Renderer;

interface FromHtml
{
    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @return Renderer
     */
    public static function fromHtml(string $html): Renderer;

    /**
     * Provide an HTML path or URL to build the PDF from.
     *
     * @param string $path
     * @return Renderer
     */
    public static function fromHtmlFile(string $path): Renderer;
}
