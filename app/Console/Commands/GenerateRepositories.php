<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRepositories extends Command
{
    // Command name and description
    protected $signature = 'make:repositories';
    protected $description = 'Generate repositories for all models';

    // Path to store repositories
    protected $repositoryPath = 'app/Repositories/SQL';

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
            $repositoryName = $modelName . 'Repository';
            $repositoryFile = $this->repositoryPath . '/' . $repositoryName . '.php';

            // Check if repository already exists
            if (!File::exists($repositoryFile)) {
                // Create repository file
                $repositoryContent = $this->generateRepositoryContent($modelName);
                File::put($repositoryFile, $repositoryContent);
                $this->info("Created repository: $repositoryName");
            } else {
                $this->warn("Repository $repositoryName already exists.");
            }
        }
    }

    // Generate repository content
    protected function generateRepositoryContent($modelName)
    {
        $namespace = 'App\Repositories\SQL';
        $modelNamespace = "App\\Models\\$modelName";
        $modelInterface = "App\Repositories\Contracts\\$modelName"."RepositoryInterface";

        return <<<PHP
        <?php

        namespace $namespace;

        use $modelNamespace;
        use $modelInterface;

        class {$modelName}Repository extends BaseRepository implements {$modelName}RepositoryInterface
        {
            protected \${$modelName};

            public function __construct($modelName \${$modelName})
            {
                parent::__construct(\${$modelName});
                \$this->{$modelName} = \${$modelName};
            }

        }
        PHP;
    }
}

