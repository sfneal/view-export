<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
use Sfneal\Queueables\AbstractJob;
use Sfneal\ViewExport\Pdf\Utils\PdfRenderer;

class PdfExportJob extends AbstractJob
{
    /**
     * @var string Queue to use
     */
    public $queue = 'high';

    /**
     * @var string Queue connection to use
     */
    public $connection = 'database';

    /**
     * @var PdfRenderer
     */
    protected $renderer;

    /**
     * PdfExportJob constructor.
     *
     * @param PdfRenderer $renderer
     */
    public function __construct(PdfRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render a PDF & upload it to AWS S3.
     *
     * @return string
     * @throws Exception
     */
    public function handle(): string
    {
        return $this->renderer->handle()->path();
    }
}
