<?php

namespace App\Providers;


// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
    {
        foreach ($this->getModels() as $model) {
            $this->app->bind(
                "App\Repositories\Interface\\{$model}RepositoryInterface",
                "App\Repositories\SQL\\{$model}Repository"
            );
        }

    }
 
    protected function getModels()
    {
        $files = Storage::disk('app')->files('Models');
        return collect($files)->map(function ($file) {
            return basename($file, '.php');
        });
    }

}