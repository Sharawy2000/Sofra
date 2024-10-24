<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateInterfaces extends Command
{
    // Command name and description
    protected $signature = 'make:interfaces';
    protected $description = 'Generate interfaces for all models';

    // Path to store repositories
    protected $repositoryPath = 'app/Repositories/Contracts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Ensure repository directory exists
        if (!File::exists($this->repositoryPath)) {
            File::makeDirectory($this->repositoryPath, 0755, true);
        }

        // Get all models in app/Models directory
        $modelPath = app_path('Models');
        $models = File::files($modelPath);

        foreach ($models as $model) {
            $modelName = pathinfo($model, PATHINFO_FILENAME);
            $repositoryName = $modelName . 'RepositoryInterface';
            $repositoryFile = $this->repositoryPath . '/' . $repositoryName . '.php';

            // Check if repository already exists
            if (!File::exists($repositoryFile)) {
                // Create repository file
                $repositoryContent = $this->generateRepositoryContent($modelName);
                File::put($repositoryFile, $repositoryContent);
                $this->info("Created interface: $repositoryName");
            } else {
                $this->warn("Interface $repositoryName already exists.");
            }
        }
    }

    // Generate interface content
    protected function generateRepositoryContent($modelName)
    {
        $namespace = 'App\Repositories\Contracts';

        return <<<PHP
        <?php

        namespace $namespace;

        interface {$modelName}RepositoryInterface
        {
            
        }
        PHP;
    }
}


