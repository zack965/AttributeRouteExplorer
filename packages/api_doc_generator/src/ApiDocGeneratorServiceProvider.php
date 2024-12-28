<?php

namespace Zack\ApiDocGenerator;

use Illuminate\Support\ServiceProvider;

class ApiDocGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //  dd("<?php echo");
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
    public function register() {}
}
