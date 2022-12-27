<?php

namespace App\Console\Commands;

use App\Contracts\Api\CategoryInterface;
use App\Contracts\ImportDriverInterface;
use Illuminate\Console\Command;

class ParseJsonCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:parse:json:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for parsing categories from file';

    /**
     * @var string
     */
    protected $importFile = 'import/json/categories.json';

    /**
     * @var ImportDriverInterface
     */
    protected $driver;
    /**
     * @var CategoryInterface
     */
    protected $service;

    /**
     * @param ImportDriverInterface $driver
     * @param CategoryInterface $service
     */
    public function __construct(ImportDriverInterface $driver, CategoryInterface $service)
    {
        $this->driver = $driver;
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = storage_path($this->importFile);

        $items = $this->driver->setupImport(['filePath' => $file])->processImport();

        foreach ($items as $key => $item) {
            $validation = $this->service->validate($item);
            if ($validation->fails()) {
                $this->error('Element ' . $key . ' has errors: ' . $validation->errors());
                continue;
            }

            if (isset($item['id']) && intval($item['id'])) {
                $this->service->update($item, $item['id']);
                $this->info('Element with id ' . $item['id'] . ' successfully updated');
            } else {
                $this->service->create($item);
                $this->info('Element ' . $key . ' successfully added');
            }
        }

        return Command::SUCCESS;
    }
}
