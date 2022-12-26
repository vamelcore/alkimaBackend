<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ImportDriverInterface
{
    /**
     * @param array $config
     * @return mixed
     */
    public function setupImport(array $config = []);


    /**
     * @return Collection
     */
    public function processImport(): Collection;
}
