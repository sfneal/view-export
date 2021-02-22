<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Exception;
use Sfneal\Actions\AbstractAction;

class PdfExportAction extends AbstractAction
{
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
     * CreatePdfFromViewAction constructor.
     *
     * @param string $path
     * @param string $view
     * @param array|null $view_data
     */
    public function __construct(string $path, string $view, array $view_data = [])
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
    public function execute(): string
    {
        // Create & Render the PDF
        $exporter = PdfExportService::fromViewData($this->view, $this->view_data)->render();

        // Upload the PDF to AWS S3
        $exporter->upload($this->path);

        // Return the path
        return $exporter->getPath();
    }
}
