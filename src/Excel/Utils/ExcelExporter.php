<?php

namespace Sfneal\ViewExport\Excel\Utils;

use Maatwebsite\Excel\Facades\Excel;
use Sfneal\ViewExport\Support\ExcelExport;
use Sfneal\ViewExport\Support\Exporter;

class ExcelExporter extends Exporter
{
    // todo: add ability to download

    /**
     * @var ExcelExport
     */
    private $excel;

    /**
     * ExcelExporter constructor.
     *
     * @param ExcelExport $excel
     */
    public function __construct(ExcelExport $excel)
    {
        $this->excel = $excel;

        // Only set output if the ExcelExport has a 'view' method
        if (method_exists($excel, 'view')) {
            $this->output = $excel->view()->render();
        }
    }

    /**
     * Upload an Excel file to an AWS S3 file store.
     *
     * @param string $path
     * @return $this
     */
    public function upload(string $path): self
    {
        $this->uploadPath = $path;
        Excel::store($this->excel, $path, 's3');

        return $this;
    }

    /**
     * Store an Excel on the local file system.
     *
     * @param string $storagePath
     * @return $this
     */
    public function store(string $storagePath): self
    {
        $this->localPath = $storagePath;
        Excel::store($this->excel, $storagePath);

        return $this;
    }
}
