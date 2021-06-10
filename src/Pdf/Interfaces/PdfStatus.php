<?php

namespace Sfneal\ViewExport\Pdf\Interfaces;

interface PdfStatus
{
    // todo: add tests

    /**
     * Determine if the Model's PDF exists.
     *
     * @return bool
     */
    public function pdfExists(): bool;

    /**
     * Determine if the Model's PDF is processing.
     *
     * @return bool
     */
    public function pdfProcessing(): bool;
}
