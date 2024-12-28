<?php

namespace Zack\ApiDocGenerator\HttpControllers;

use App\Services\AttributesService;
use Illuminate\Routing\Controller;

class ApiDocController extends Controller
{
    public function index()
    {
        $data = AttributesService::getApiDocumentationAttributes();
        $groups = AttributesService::getDocumentGroupData();
        /* return response()->json([
            "data" => $data,
            "groups" => $groups,
        ]); */
        return view("apiDocs.index")->with("groups", $groups)->with("data", $data);
    }
    public function indexJson()
    {
        $data = AttributesService::getApiDocumentationAttributes();
        $groups = AttributesService::getDocumentGroupData();
        return response()->json([
            "data" => $data,
            "groups" => $groups,
        ]);
    }
}
