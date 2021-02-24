<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
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
     * Create a PDF from a view & return its file path.
     *
     * @throws Exception
     * @return string
     */
    public function handle(): string
    {
        // Create & Render the PDF
        $exporter = PdfExportService::fromView(view($this->view, $this->view_data))->handle();

        // Upload the PDF to AWS S3
        $exporter->upload($this->path);

        // Return the path
        return $exporter->path();
    }
}
