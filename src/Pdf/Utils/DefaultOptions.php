<?php

namespace Sfneal\ViewExport\Pdf\Utils;

use Dompdf\Options;

class DefaultOptions extends Options
{
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
}
