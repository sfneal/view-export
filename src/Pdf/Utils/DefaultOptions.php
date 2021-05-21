<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Options;

class DefaultOptions extends Options
{
    /**
     * Set the content loader convention.
     *
     *  - If this setting is set to 'disk' PDF content will be exported to a static HTML.
     *  - If this setting is set to 'memory' PDF content will be loaded directly to the PDF.
     *
     * @var string
     */
    private $contentLoader;

    /**
     * DefaultOptions constructor.
     *
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        parent::__construct($attributes);

        $this->setDefaults();
    }

    /**
     * Set the default Dompdf Options.
     *
     * @return void
     */
    private function setDefaults(): void
    {
        // Set file permissions
        $this->setChroot(config('view-export.pdf.chroot'));

        // Set font cache directory (if overwritten in config)
        if (config('view-export.pdf.font_cache')) {
            $this->setFontCache(config('view-export.pdf.font_cache'));
        }

        // Set parsing options
        $this->setIsPhpEnabled(config('view-export.pdf.php_enabled'));
        $this->setIsJavascriptEnabled(config('view-export.pdf.javascript_enabled'));
        $this->setIsHtml5ParserEnabled(config('view-export.pdf.html5_parsable'));
        $this->setIsRemoteEnabled(config('view-export.pdf.remote_enabled'));

        // Set logging directory
        $this->setLogOutputFile(config('view-export.pdf.log_output'));

        // Set content loader
        $this->setContentLoader(config('view-export.pdf.content_loader'));
    }

    /**
     * Set the paper orientation to 'landscape'.
     *
     * @return $this
     */
    public function setLandscape(): self
    {
        $this->setDefaultPaperOrientation('landscape');

        return $this;
    }

    /**
     * Set the paper orientation to 'portrait'.
     *
     * @return $this
     */
    public function setPortrait(): self
    {
        $this->setDefaultPaperOrientation('portrait');

        return $this;
    }

    /**
     * Set the content loader type as 'disk'.
     *
     * @return $this
     */
    public function setContentLoaderDisk(): self
    {
        return $this->setContentLoader('disk');
    }

    /**
     * Set the content loader type as 'memory'.
     *
     * @return $this
     */
    public function setContentLoaderMemory(): self
    {
        return $this->setContentLoader('memory');
    }

    /**
     * Set the content loader type.
     *
     * @param string $loader
     * @return $this
     */
    private function setContentLoader(string $loader): self
    {
        $this->contentLoader = $loader;

        return $this;
    }

    /**
     * Determine if the content loader type is 'disk'.
     *
     * @return bool
     */
    public function isContentLoaderDisk(): bool
    {
        return $this->getContentLoader() == 'disk';
    }

    /**
     * Determine if the content loader type is 'memory'.
     *
     * @return bool
     */
    public function isContentLoaderMemory(): bool
    {
        return $this->getContentLoader() == 'memory';
    }

    /**
     * Retrieve the content loader type.
     *
     * @return string
     */
    public function getContentLoader(): string
    {
        return $this->contentLoader;
    }
}
