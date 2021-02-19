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
     * Set the default Dompdf Options
     *
     * @return $this
     */
    private function setDefaults(): self
    {
        $this->setIsPhpEnabled(config('view-export.php_enabled'));
        $this->setIsJavascriptEnabled(config('view-export.javascript_enabled'));
        $this->setIsHtml5ParserEnabled(config('view-export.html5_parsable'));
        $this->setIsRemoteEnabled(config('view-export.remote_enabled'));

        // Set file permissions
        $this->setChroot(config('view-export.chroot'));

        return $this;
    }
}
