<?php

namespace DiogoGPinto\FilamentPageContext\Commands;

use Illuminate\Console\Command;

class FilamentPageContextCommand extends Command
{
    public $signature = 'filament-page-context';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
