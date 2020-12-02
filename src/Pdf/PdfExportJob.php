<?php

namespace Sfneal\ViewExport\Pdf;

use Sfneal\Dompdf\Exception;
use Sfneal\Queueables\AbstractJob;

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
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var array|null
     */
    protected $view_data;

    /**
     * CreatePdfFromViewJob constructor.
     *
     * @param string     $path
     * @param string     $view
     * @param array|null $view_data
     */
    public function __construct(string $path, string $view, array $view_data = null)
    {
        $this->path = $path;
        $this->view = $view;
        $this->view_data = $view_data;
    }

    /**
     * Create a PDF from a View.
     *
     * @throws Exception
     *
     * @return mixed|void
     */
    public function handle()
    {
        (new PdfExportAction($this->path, $this->view, $this->view_data))->execute();
    }
}
