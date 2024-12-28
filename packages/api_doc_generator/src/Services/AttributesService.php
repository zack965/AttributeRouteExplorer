<?php

namespace Zack\ApiDocGenerator\Services;


use App\Helpers\PathHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;
use Zack\ApiDocGenerator\Attributes\ApiDocumentationRoot;
use Zack\ApiDocGenerator\Attributes\GroupRoute;
use Zack\ApiDocGenerator\Attributes\Route;

class AttributesService
{
    public static function getApiDocumentationAttributes(): array
    {
        // Create a reflection class for the parent Controller class
        $reflection = new ReflectionClass(Controller::class);
        // Get the attributes of the class
        $attributes = $reflection->getAttributes(ApiDocumentationRoot::class);
        // Check if the attribute exists
        if (!empty($attributes)) {
            // Get the instance of the attribute
            $apiDocumentationRootInstance = $attributes[0]->newInstance();

            // Access the properties of the attribute
            $title = $apiDocumentationRootInstance->title;
            $description = $apiDocumentationRootInstance->description;

            return [
                'title' => $title,
                'description' => $description,
            ];
        }

        return [
            'error' => 'No ApiDocumentationRoot attribute found.'
        ];
    }
    public static function getDocumentGroupData(): array
    {
        $directory = app_path('Http/Controllers');
        $namespace = 'App\\Http\\Controllers\\';
        $results = [];

        // Get all PHP files in the specified directory recursively
        $files = File::allFiles($directory);

        foreach ($files as $file) {
            // Convert file path to class name
            $class = AttributesService::getClassFromFile($file, $namespace);

            if (class_exists($class)) {
                $reflectionClass = new ReflectionClass($class);

                // Check for GroupRoute attribute
                $attributes = $reflectionClass->getAttributes(GroupRoute::class);

                $routes = [];
                foreach ($reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                    $methodAttributes = $method->getAttributes(Route::class);
                    foreach ($methodAttributes as $attribute) {
                        $new_routes = $attribute->newInstance();
                        $routes[] = [
                            "path" =>  env("APP_URL") . "/api" . $new_routes->getPath(),
                            "method" => $new_routes->getMethod(),
                            "description" => $new_routes->getDescription(),
                            "parameters" => $new_routes->getParameters(),
                            "request" => $new_routes->getRequest(),
                        ];
                    }
                }

                if (!empty($attributes)) {
                    // Instantiate the attribute and retrieve its properties
                    $groupRouteInstance = $attributes[0]->newInstance();
                    $results[] = [
                        'groupName' => $groupRouteInstance->groupName,
                        'description' => $groupRouteInstance->description,
                        'routes' => $routes,
                    ];
                }
            }
        }

        return $results;
    }

    public static  function getClassFromFile($file, $namespace): string
    {
        // Remove base directory and ".php" from file path
        $relativePath = str_replace([base_path('app/Http/Controllers/'), '/', '.php'], ['', '\\', ''], $file->getRealPath());

        // Combine the namespace with the relative path
        return $namespace . $relativePath;
    }
}
