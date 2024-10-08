<?php

namespace PragmaGoTech\Interview\Fee;

use PragmaGoTech\Interview\FeeStructureProvider;

class JsonFeeStructureProvider implements FeeStructureProvider
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFeeStructure(): array
    {
        $json = file_get_contents($this->filePath);
        return json_decode($json, true);
    }
}
