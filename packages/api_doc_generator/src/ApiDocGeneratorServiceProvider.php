<?php

namespace Zack\ApiDocGenerator;

use Illuminate\Support\ServiceProvider;

class ApiDocGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //  dd("<?php echo");
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->publishes([
            __DIR__ . '/../config/api_doc_generator.php' => config_path('api_doc_generator.php'),
        ]);
    }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/api_doc_generator.php',
            'api_doc_generator'
        );
    }
}
