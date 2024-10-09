<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFeatureCommand extends Command
{
    protected $signature = 'make:feature {feature?} {platform?}';
    protected $description = 'Create a new feature enum';

    public function handle()
    {
        $feature = $this->argument('feature');

        if (empty($feature)) {
            $feature = $this->ask('Please provide a name for the feature');
        }

        $availablePlatform = config("feature.platforms");
        while (empty($platform) || !in_array($platform, $availablePlatform)) {
            $platform = $this->askWithCompletion(
                "Please choose feature from available platform? <" . implode(", ", $availablePlatform) . ">",
                $availablePlatform
            );
        }

        $className = ucfirst(strtolower($feature)) . ucfirst(strtolower($platform));
        $path = app_path("Enums/Features/{$className}.php");

        if (File::exists($path)) {
            $this->error("Feature {$className} already exists!");
            return;
        }

        $stub = file_get_contents(app_path('Console/Stubs/feature.stub'));
        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ platform }}', "'" . strtolower($platform) . "'", $stub);
        $stub = str_replace('{{ feature }}', "'" . strtolower($feature) . "'", $stub);

        File::ensureDirectoryExists(app_path('Enums/Features'));
        File::put($path, $stub);

        $this->info("Feature {$className} created successfully.");
    }
}
