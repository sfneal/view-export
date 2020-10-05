<?php

namespace Sfneal\ViewExport\Excel;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Facades\Excel;
use Sfneal\Actions\AbstractAction;

// TODO: create package BasicExcelExport
class ExcelExportAction extends AbstractAction implements FromView, ShouldAutoSize
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
     * @var array
     */
    protected $data;

    /**
     * ExcelExportAction constructor.
     *
     * Initialize ExcelExporter by passing view name and data array
     *
     * @param string $path
     * @param string $view
     * @param array $data
     */
    public function __construct(string $path, string $view, $data = [])
    {
        $this->path = $path;
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute()
    {
        return Excel::store($this, $this->path, 's3');
    }

    /**
     * Render the view.
     *
     * @return View
     */
    public function view(): View
    {
        return view(
            $this->view,
            $this->data
        );
    }
}
