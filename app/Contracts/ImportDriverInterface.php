<?php

namespace App\Contracts;

use App\Contracts\Api\CrudInterface;
use Illuminate\Support\Collection;

interface ImportDriverInterface
{

    /**
     * @param CrudInterface $service
     * @param array $config
     * @return mixed
     */
    public function setupImport(CrudInterface $service, array $config = []);


    /**
     * @return Collection
     */
    public function processImport(): Collection;
}
