<?php

namespace App\Utilities;

use App\Contracts\Api\CrudInterface;
use App\Contracts\ImportDriverInterface;
use Illuminate\Support\Collection;
use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonMachine\Items;

class JsonFileImportDriver implements ImportDriverInterface
{
    protected const ALLOWED_FILE_EXTENSION = 'json';

    protected $filePath;

    protected $service;

    protected function processFile()
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

    public function setupImport(CrudInterface $service, array $config = [])
    {
        $this->service = $service;
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

    public function processImport(): Collection
    {
        $result = [];

        $items = $this->processFile();

        foreach ($items as $key => $item) {

            $validation = $this->service->validate($item);

            if ($validation->fails()) {
                $result[$key] = [
                    'success' => false,
                    'message' => 'Element with key ' . $key . ' has errors: ' . $validation->errors(),
                ];
                continue;
            }

            if (isset($item['id']) && intval($item['id'])) {
                $this->service->update($item, $item['id']);
                $result[$key] = [
                    'success' => true,
                    'message' => 'Element with id ' . $item['id'] . ' successfully updated',
                ];
            } else {
                $this->service->create($item);
                $result[$key] = [
                    'success' => true,
                    'message' => 'Element with key ' . $key . ' successfully added',
                ];
            }
        }

        return collect($result);
    }
}
