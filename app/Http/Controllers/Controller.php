<?php

namespace App\Http\Controllers;

use App\Attributes\ApiDocumentationRoot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

#[ApiDocumentationRoot("api documentation", "To do api documentation")]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
