<?php

namespace App\Http\Controllers;

use App\Services\AttributesService;
use Illuminate\Http\Request;

class ApiDocumentationController extends Controller
{
    //
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
