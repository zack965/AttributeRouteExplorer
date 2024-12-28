<?php

use Illuminate\Support\Facades\Route;

Route::get('/appolo', function () {

    return config("api_doc_generator.app_name");
});
