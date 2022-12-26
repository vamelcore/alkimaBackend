<?php

namespace App\Utilities;

use App\Contracts\ImportDriverInterface;
use Illuminate\Support\Collection;
use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonMachine\Items;

class JsonFileImportDriver implements ImportDriverInterface
{
    protected const ALLOWED_FILE_EXTENSION = 'json';
    /**
     * @var null
     */
    protected $filePath = null;

    /**
     * @param array $config
     * @return mixed|void
     */
    public function setupImport(array $config = [])
    {
        if (isset($config['filePath']) && !empty($config['filePath'])) {
            $pathInfo = pathinfo($config['filePath']);
            if (file_exists($config['filePath'])
                && isset($pathInfo['extension'])
                && self::ALLOWED_FILE_EXTENSION == $pathInfo['extension']) {
                $this->filePath = $config['filePath'];
            }
        }

        return $this;
    }

    /**
     * @return Collection
     * @throws \JsonMachine\Exception\InvalidArgumentException
     */
    public function processImport(): Collection
    {
        $data = [];

        if ($this->filePath) {
            $objects = Items::fromFile($this->filePath, ['decoder' => new ExtJsonDecoder(true)]);
            foreach ($objects as $object) {
                $data[] = $object;
            }
        }

        return collect($data);
    }
}
