<?php

namespace App\Console\Commands;

use App\Contracts\ImportDriverInterface;
use App\Services\Api\ProductService;
use Illuminate\Console\Command;

class ParseJsonProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:parse:json:products {filePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for parsing products from file';

    /**
     * @var ImportDriverInterface
     */
    protected $driver;

    /**
     * @var ProductService
     */
    protected $service;

    /**
     * @param ImportDriverInterface $driver
     */
    public function __construct(ImportDriverInterface $driver)
    {
        $this->driver = $driver;
        $this->service = new ProductService();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = storage_path($this->argument('filePath'));

        $items = $this->driver->setupImport($this->service, ['filePath' => $file])->processImport();

        foreach ($items as $item) {
            if ($item['success']) {
                $this->info($item['message']);
            } else {
                $this->error($item['message']);
            }
        }

        return Command::SUCCESS;
    }
}
