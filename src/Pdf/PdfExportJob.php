<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
use Sfneal\Queueables\AbstractJob;
use Sfneal\ViewExport\Pdf\Utils\Renderer;

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
     * @var Renderer
     */
    private $renderer;

    /**
     * PdfExportJob constructor.
     *
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
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
        $this->renderer->handle()->path();
    }
}
