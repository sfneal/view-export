<?php

namespace Sfneal\ViewExport\Pdf;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Sfneal\Actions\AbstractAction;
use Sfneal\Dompdf\Exception;

class PdfExportAction extends AbstractAction implements FromView
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
    public function execute(): string
    {
        // Declare PDF options
        $options = (new Options())
            ->setIsPhpEnabled(true)
            ->setIsJavascriptEnabled(true)
            ->setIsHtml5ParserEnabled(true)
            ->setIsRemoteEnabled(true)
            ->setChroot(base_path('vendor/sfneal/dompdf'));

        // Instantiate dompdf
        $pdf = new Dompdf($options);

        // Create View
        $view = $this->view();

        // Create local HTML file path
        $localHTML = joinPaths($options->getRootDir(), uniqid().'.html');

        // Store View as HTML file
        touch($localHTML);
        file_put_contents($localHTML, $view);

        // Load HTML
        $pdf->loadHtmlFile($localHTML);

        // Render the PDF
        $pdf->render();

        // Retrieve the PDF output & Upload PDF to S3
        $this->storeFile($pdf);

        // Remove temp HTML file
        unlink($localHTML);

        return $this->path;
    }

    /**
     * Store the created PDF file, by default in S3 storage.
     *
     * @param Dompdf $pdf
     * @return mixed
     */
    protected function storeFile(Dompdf $pdf)
    {
        return s3_upload_raw($this->path, $pdf->output());
    }

    /**
     * Retrieve a View instance to be used to create a PDF.
     *
     * @return View
     */
    public function view(): View
    {
        return view(
            $this->view,
            $this->view_data
        );
    }
}
