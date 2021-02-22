<?php


namespace Sfneal\ViewExport\Pdf\Utils;


trait Metadata
{
    /**
     * Array of valid metadata keys
     *
     * @var string[]
     */
    private $validMetadataKeys = [
        'Title',
        'Author',
        'Subject',
        'Keywords',
        'Creator',
        'Producer',
        'CreationDate',
        'ModDate',
        'Trapped'
    ];

    /**
     * Metadata info to add to the PDF
     *
     *  - keys are validated from $validMetadata property
     *
     * @var array
     */
    private $metadata = [];

    /**
     * Set the entire $metadata array
     *
     * @param array $metadata
     * @return $this
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = array_filter($metadata, function ($key) {
            return $this->validateMetadata($key);
        });

        return $this;
    }

    /**
     * Add a $key, $value pair to the metadata array.
     *
     * @param string $key
     * @param $value
     * @return $this
     */
    public function addMetadata(string $key, $value): self
    {
        if ($this->validateMetadata($key)) {
            $this->metadata[$key] = $value;
        }

        return $this;
    }

    /**
     * Add Metadata to the PDF.
     *
     * @return bool
     */
    protected function applyMetadata(): bool
    {
        // Add Metadata if the array isn't empty
        $hasMetadata = ! empty($this->metadata);
        if ($hasMetadata) {
            foreach ($this->metadata as $key => $value) {
                $this->pdf->add_info($key, $value);
            }
        }

        return $hasMetadata;
    }

    /**
     * Confirm a potential metadata key is valid.
     *
     * @param string $key
     * @return bool
     */
    private function validateMetadata(string $key): bool
    {
        return in_array($key, $this->validMetadataKeys);
    }
}
