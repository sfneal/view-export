<?php

namespace Sfneal\ViewExport\Support\Interfaces;

use Sfneal\ViewExport\Support\Adapters\Renderer;

interface FromHtml
{
    /**
     * Provide an HTML string to build the PDF from.
     *
     * @param string $html
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromHtml(string $html, string $uploadPath = null): Renderer;

    /**
     * Provide an HTML path or URL to build the PDF from.
     *
     * @param string $path
     * @param string|null $uploadPath
     * @return Renderer
     */
    public static function fromHtmlFile(string $path, string $uploadPath = null): Renderer;
}
