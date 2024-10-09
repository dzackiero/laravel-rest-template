<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name?}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');

        if (empty($name)) {
            $name = $this->ask('Please provide a name for the service');
        }

        if (!str_ends_with($name, 'Service')) {
            $name .= 'Service';
        }

        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        $stub = file_get_contents(app_path('Console/Stubs/service.stub'));
        $stub = str_replace('{{ class }}', $name, $stub);

        File::ensureDirectoryExists(app_path('Services'));
        File::put($path, $stub);

        $this->info("Service {$name} created successfully.");
    }
}
