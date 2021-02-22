<?php

namespace Sfneal\ViewExport\Pdf\Utils;

class Metadata
{
    /**
     * Array of valid metadata keys.
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
        'Trapped',
    ];

    /**
     * Metadata info to add to the PDF.
     *
     *  - keys are validated from $validMetadata property
     *
     * @var array
     */
    private $metadata = [];

    /**
     * Metadata constructor.
     *
     * @param array|null $metadata
     */
    public function __construct(array $metadata = null)
    {
        if (! empty($metadata)) {
            $this->set($metadata ?? config('view-export.metadata'));
        }
    }

    /**
     * Retrieve an array of metadata.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->metadata;
    }

    /**
     * Set the entire $metadata array.
     *
     * @param array $metadata
     * @return $this
     */
    public function set(array $metadata): self
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
    public function add(string $key, $value): self
    {
        if ($this->validateMetadata($key)) {
            $this->metadata[$key] = $value;
        }

        return $this;
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
